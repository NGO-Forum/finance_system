<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\PurchaseRequestItem;
use App\Models\Department;
use App\Models\User;

use App\Mail\PurchaseRequestNotification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use Mpdf\Mpdf;
use Mpdf\HTMLParserMode;


class PurchaseRequestController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();

        $query = PurchaseRequest::with([
            'preparer',
            'reviewer',
            'approver',
        ])->latest();

        // Search
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('purchase_no', 'like', "%{$search}%")
                    ->orWhere('purpose', 'like', "%{$search}%")
                    ->orWhere('donor', 'like', "%{$search}%")
                    ->orWhere('donor_code', 'like', "%{$search}%")
                    ->orWhere('budget_line', 'like', "%{$search}%");
            });
        }

        // Status Filter
        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        // Permission
        if ($user->role?->name !== 'Admin') {
            $query->where('prepared_by', $user->id);
        }

        $purchaseRequests = $query
            ->paginate(10);

        return view(
            'purchase-requests.index',
            compact('purchaseRequests')
        );
    }

    public function create()
    {
        $user = auth()->user();

        $reviewers = User::with('role')
            ->whereHas('role', function ($query) {
                $query->where('name', 'Manager');
            })
            ->orderBy('name')
            ->get();


        $approvers = User::with('role')
            ->whereHas('role', function ($query) {
                $query->whereIn('name', [
                    'Manager',
                    'ED',
                ]);
            })
            ->orderBy('name')
            ->get();

        $lastPurchase = PurchaseRequest::orderByDesc('id')
            ->first();


        if ($lastPurchase) {

            $lastNumber = (int) substr(
                $lastPurchase->purchase_no,
                -5
            );

            $nextNumber = $lastNumber + 1;
        } else {

            $nextNumber = 1;
        }


        $purchaseNo = sprintf(
            'PR-%s-%05d',
            date('Y'),
            $nextNumber
        );


        return view(
            'purchase-requests.create',
            compact(
                'purchaseNo',
                'user',
                'reviewers',
                'approvers'
            )
        );
    }

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'request_date' => [
                'required',
                'date',
            ],

            'donor' => [
                'nullable',
                'string',
                'max:255',
            ],

            'donor_code' => [
                'nullable',
                'string',
                'max:255',
            ],

            'budget_line' => [
                'nullable',
                'string',
                'max:255',
            ],

            'purpose' => [
                'required',
                'string',
            ],

            /*
        |--------------------------------------------------------------------------
        | Reviewer
        |--------------------------------------------------------------------------
        */

            'reviewed_by' => [
                'required',
                'exists:users,id',

                function ($attribute, $value, $fail) {

                    $selectedUser = User::with('role')->find($value);

                    if (!$selectedUser) {
                        $fail('The selected reviewer does not exist.');
                        return;
                    }

                    if ($selectedUser->role?->name !== 'Manager') {
                        $fail(
                            'The selected reviewer must have the Manager role.'
                        );
                        return;
                    }

                    if (!$selectedUser->email) {
                        $fail(
                            'The selected Manager does not have an email address.'
                        );
                    }
                },
            ],

            /*
        |--------------------------------------------------------------------------
        | Approver
        |--------------------------------------------------------------------------
        */

            'approved_by' => [
                auth()->user()->role?->name === 'Manager'
                    ? 'nullable'
                    : 'required',

                'nullable',
                'exists:users,id',

                function ($attribute, $value, $fail) {

                    // Manager does not select ED.
                    // Controller automatically selects ED.
                    if (auth()->user()->role?->name === 'Manager') {
                        return;
                    }

                    if (!$value) {
                        return;
                    }

                    $selectedUser = User::with('role')->find($value);

                    if (!$selectedUser) {
                        $fail('The selected approver does not exist.');
                        return;
                    }

                    if (!in_array(
                        $selectedUser->role?->name,
                        ['Manager', 'ED']
                    )) {
                        $fail(
                            'The selected approver must be a Manager or ED.'
                        );
                        return;
                    }

                    if (!$selectedUser->email) {
                        $fail(
                            'The selected approver does not have an email address.'
                        );
                    }
                },
            ],

            /*
        |--------------------------------------------------------------------------
        | Items
        |--------------------------------------------------------------------------
        */

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.item_name' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.specification' => [
                'nullable',
                'string',
            ],

            'items.*.unit' => [
                'nullable',
                'string',
                'max:50',
            ],

            'items.*.unit_cost' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.quantity' => [
                'required',
                'numeric',
                'min:1',
            ],
        ]);

        try {

            /*
        |--------------------------------------------------------------------------
        | Current User
        |--------------------------------------------------------------------------
        */

            $currentUser = auth()->user();
            $currentRole = $currentUser->role?->name;

            /*
        |--------------------------------------------------------------------------
        | Initialize Approval IDs
        |--------------------------------------------------------------------------
        */

            $reviewedBy = $request->reviewed_by;
            $approvedBy = $request->approved_by;

            /*
        |--------------------------------------------------------------------------
        | Manager Creates Purchase Request
        |--------------------------------------------------------------------------
        |
        | Manager automatically becomes reviewer.
        | ED automatically becomes approver.
        |
        */

            if ($currentRole === 'Manager') {

                // Manager = Reviewer
                $reviewedBy = $currentUser->id;

                /*
            |--------------------------------------------------------------------------
            | Find ED
            |--------------------------------------------------------------------------
            */

                $ed = User::with('role')
                    ->whereHas('role', function ($query) {
                        $query->where('name', 'ED');
                    })
                    ->whereNotNull('email')
                    ->where('email', '!=', '')
                    ->orderBy('id')
                    ->first();

                if (!$ed) {

                    return back()
                        ->withInput()
                        ->with(
                            'error',
                            'No ED user with a valid email address is available for approval.'
                        );
                }

                // ED = Approver
                $approvedBy = $ed->id;
            }

            /*
        |--------------------------------------------------------------------------
        | Initial Status
        |--------------------------------------------------------------------------
        */

            $initialStatus = $currentRole === 'Manager'
                ? 'Pending ED Approval'
                : 'Pending Manager Approval';

            /*
        |--------------------------------------------------------------------------
        | Save Purchase Request
        |--------------------------------------------------------------------------
        */

            $purchaseRequest = DB::transaction(function () use (
                $request,
                $reviewedBy,
                $approvedBy,
                $initialStatus
            ) {

                /*
            |--------------------------------------------------------------------------
            | Generate Purchase Number
            |--------------------------------------------------------------------------
            */

                $lastPurchase = PurchaseRequest::orderByDesc('id')
                    ->first();

                if ($lastPurchase) {

                    $lastNumber = (int) substr(
                        $lastPurchase->purchase_no,
                        -5
                    );

                    $nextNumber = $lastNumber + 1;
                } else {

                    $nextNumber = 1;
                }

                $purchaseNo = sprintf(
                    'PR-%s-%05d',
                    date('Y'),
                    $nextNumber
                );

                /*
            |--------------------------------------------------------------------------
            | Create Header
            |--------------------------------------------------------------------------
            */

                $purchaseRequest = PurchaseRequest::create([
                    'purchase_no' => $purchaseNo,
                    'request_date' => $request->request_date,
                    'donor' => $request->donor,
                    'donor_code' => $request->donor_code,
                    'budget_line' => $request->budget_line,
                    'purpose' => $request->purpose,

                    'prepared_by' => auth()->id(),
                    'reviewed_by' => $reviewedBy,
                    'approved_by' => $approvedBy,

                    'grand_total' => 0,
                    'status' => $initialStatus,
                ]);

                /*
            |--------------------------------------------------------------------------
            | Create Items
            |--------------------------------------------------------------------------
            */

                $grandTotal = 0;

                foreach ($request->items as $item) {

                    $unitCost = (float) $item['unit_cost'];
                    $quantity = (float) $item['quantity'];

                    $total = $unitCost * $quantity;

                    $grandTotal += $total;

                    $purchaseRequest->items()->create([
                        'item_name' => $item['item_name'],
                        'specification' => $item['specification'] ?? null,
                        'unit' => $item['unit'] ?? null,
                        'unit_cost' => $unitCost,
                        'quantity' => $quantity,
                        'total' => $total,
                    ]);
                }

                /*
            |--------------------------------------------------------------------------
            | Save Grand Total
            |--------------------------------------------------------------------------
            */

                $purchaseRequest->update([
                    'grand_total' => $grandTotal,
                ]);

                return $purchaseRequest;
            });

            /*
        |--------------------------------------------------------------------------
        | Reload Relationships
        |--------------------------------------------------------------------------
        */

            $purchaseRequest->load([
                'preparer',
                'reviewer',
                'approver',
                'items',
            ]);

            /*
        |--------------------------------------------------------------------------
        | SEND EMAIL
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Email failure should NOT delete or rollback
        | the Purchase Request.
        |
        */

            $emailSent = false;
            $emailRecipient = null;
            $emailError = null;

            try {

                /*
            |--------------------------------------------------------------------------
            | Manager Creates
            | Email → ED
            |--------------------------------------------------------------------------
            */

                if ($currentRole === 'Manager') {

                    $recipient = $purchaseRequest->approver;

                    if (!$recipient) {

                        throw new \Exception(
                            'ED approver was not found.'
                        );
                    }

                    if (!$recipient->email) {

                        throw new \Exception(
                            'ED approver does not have an email address.'
                        );
                    }

                    $emailRecipient = $recipient->email;

                    Mail::to($recipient->email)->send(
                        new PurchaseRequestNotification(
                            $purchaseRequest,
                            $recipient,
                            'approver'
                        )
                    );

                    $emailSent = true;

                    Log::info(
                        'Purchase Request email sent to ED.',
                        [
                            'purchase_request_id' => $purchaseRequest->id,
                            'purchase_no' => $purchaseRequest->purchase_no,
                            'recipient' => $recipient->email,
                        ]
                    );
                }

                /*
            |--------------------------------------------------------------------------
            | Staff Creates
            | Email → Manager
            |--------------------------------------------------------------------------
            */ else {

                    $recipient = $purchaseRequest->reviewer;

                    if (!$recipient) {

                        throw new \Exception(
                            'Manager reviewer was not found.'
                        );
                    }

                    if (!$recipient->email) {

                        throw new \Exception(
                            'Manager reviewer does not have an email address.'
                        );
                    }

                    $emailRecipient = $recipient->email;

                    Mail::to($recipient->email)->send(
                        new PurchaseRequestNotification(
                            $purchaseRequest,
                            $recipient,
                            'reviewer'
                        )
                    );

                    $emailSent = true;

                    Log::info(
                        'Purchase Request email sent to Manager.',
                        [
                            'purchase_request_id' => $purchaseRequest->id,
                            'purchase_no' => $purchaseRequest->purchase_no,
                            'recipient' => $recipient->email,
                        ]
                    );
                }
            } catch (\Throwable $mailException) {

                $emailError = $mailException->getMessage();

                Log::error(
                    'Purchase Request email failed.',
                    [
                        'purchase_request_id' => $purchaseRequest->id,
                        'purchase_no' => $purchaseRequest->purchase_no,
                        'recipient' => $emailRecipient,
                        'error' => $mailException->getMessage(),
                        'file' => $mailException->getFile(),
                        'line' => $mailException->getLine(),
                    ]
                );
            }

            /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

            if ($emailSent) {

                $successMessage = $currentRole === 'Manager'
                    ? 'Purchase Request created successfully. The ED has been notified by email.'
                    : 'Purchase Request created successfully. The selected Manager has been notified by email.';
            } else {

                $successMessage = $currentRole === 'Manager'
                    ? 'Purchase Request created successfully, but the ED email could not be sent.'
                    : 'Purchase Request created successfully, but the Manager email could not be sent.';
            }

            /*
        |--------------------------------------------------------------------------
        | Redirect To Index
        |--------------------------------------------------------------------------
        */

            return redirect()
                ->route('purchase-requests.index')
                ->with('success', $successMessage)
                ->with('email_sent', $emailSent)
                ->with('email_error', $emailError);
        } catch (\Throwable $e) {

            /*
        |--------------------------------------------------------------------------
        | Database / General Error
        |--------------------------------------------------------------------------
        */

            Log::error(
                'Purchase Request creation failed.',
                [
                    'user_id' => auth()->id(),
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Failed to create Purchase Request. '
                        . $e->getMessage()
                );
        }
    }

    public function show(PurchaseRequest $purchaseRequest)
    {
        $user = auth()->user();

        if (!in_array($user->role?->name, ['Admin', 'Finance'])) {

            if (
                $purchaseRequest->prepared_by != $user->id &&
                $purchaseRequest->reviewed_by != $user->id &&
                $purchaseRequest->approved_by != $user->id
            ) {
                abort(403, 'Unauthorized.');
            }
        }

        $purchaseRequest->load([
            'preparer',
            'reviewer',
            'approver',
            'items',
        ]);

        return view(
            'purchase-requests.show',
            compact('purchaseRequest')
        );
    }

    public function edit(PurchaseRequest $purchaseRequest)
    {
        $user = auth()->user();

        if (!in_array($user->role?->name, ['Admin', 'Finance'])) {

            if ($purchaseRequest->prepared_by != $user->id) {
                abort(403, 'Unauthorized.');
            }
        }

        if (in_array($purchaseRequest->status, [
            'Approved',
            'Cancelled',
        ])) {

            return redirect()
                ->route('purchase-requests.index')
                ->with(
                    'error',
                    'This Purchase Request cannot be edited.'
                );
        }

        $purchaseRequest->load([
            'items',
            'preparer',
            'reviewer',
            'approver',
        ]);

        $managers = User::with('role')
            ->whereHas('role', function ($q) {
                $q->where('name', 'Manager');
            })
            ->orderBy('name')
            ->get();

        $finances = User::with('role')
            ->whereHas('role', function ($q) {
                $q->where('name', 'Finance');
            })
            ->orderBy('name')
            ->get();

        return view(
            'purchase-requests.edit',
            compact(
                'purchaseRequest',
                'managers',
                'finances',
                'user'
            )
        );
    }

    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        $request->validate([

            'request_date' => 'required|date',

            'donor' => 'nullable|string|max:255',

            'donor_code' => 'nullable|string|max:255',

            'budget_line' => 'nullable|string|max:255',

            'purpose' => 'required|string',

            'reviewed_by' => 'nullable|exists:users,id',

            'approved_by' => 'nullable|exists:users,id',

            // Purchase Items
            'items' => 'required|array|min:1',

            'items.*.item_name' => 'required|string|max:255',

            'items.*.specification' => 'nullable|string',

            'items.*.unit' => 'nullable|string|max:50',

            'items.*.unit_cost' => 'required|numeric|min:0',

            'items.*.quantity' => 'required|numeric|min:1',

        ]);

        if (
            auth()->user()->role?->name != 'Admin' &&
            $purchaseRequest->prepared_by != auth()->id()
        ) {
            abort(403, 'Unauthorized.');
        }

        DB::transaction(function () use ($request, $purchaseRequest) {

            $purchaseRequest->update([

                'request_date' => $request->request_date,

                'donor' => $request->donor,

                'donor_code' => $request->donor_code,

                'budget_line' => $request->budget_line,

                'purpose' => $request->purpose,

                'reviewed_by' => $request->reviewed_by,

                'approved_by' => $request->approved_by,

                // Reset workflow after editing
                'status' => 'Pending Manager Approval',

                'reviewed_at' => null,

                'approved_at' => null,

            ]);

            $purchaseRequest->items()->delete();

            $grandTotal = 0;

            foreach ($request->items as $item) {

                $unitCost = (float) $item['unit_cost'];

                $quantity = (float) $item['quantity'];

                $total = $unitCost * $quantity;

                $grandTotal += $total;

                $purchaseRequest->items()->create([

                    'item_name'     => $item['item_name'],

                    'specification' => $item['specification'] ?? null,

                    'unit'          => $item['unit'] ?? null,

                    'unit_cost'     => $unitCost,

                    'quantity'      => $quantity,

                    'total'         => $total,

                ]);
            }

            $purchaseRequest->update([

                'grand_total' => $grandTotal,

            ]);
        });

        return redirect()
            ->route('purchase-requests.index', $purchaseRequest)
            ->with(
                'success',
                'Purchase Request updated successfully.'
            );
    }

    public function destroy(PurchaseRequest $purchaseRequest)
    {
        $user = auth()->user();


        if (
            !in_array($user->role?->name, ['Admin', 'Finance']) &&
            $purchaseRequest->prepared_by != $user->id
        ) {
            abort(403, 'Unauthorized.');
        }

        if (in_array($purchaseRequest->status, [
            'Approved',
            'Pending Finance Approval',
        ])) {

            return redirect()
                ->route('purchase-requests.index')
                ->with(
                    'error',
                    'This Purchase Request cannot be deleted.'
                );
        }

        DB::transaction(function () use ($purchaseRequest) {

            /*
        |--------------------------------------------------------------------------
        | Delete Signature
        |--------------------------------------------------------------------------
        */

            if (
                $purchaseRequest->prepared_signature &&
                Storage::disk('public')->exists($purchaseRequest->prepared_signature)
            ) {
                Storage::disk('public')->delete(
                    $purchaseRequest->prepared_signature
                );
            }


            if (
                $purchaseRequest->reviewer_signature &&
                Storage::disk('public')->exists($purchaseRequest->reviewer_signature)
            ) {
                Storage::disk('public')->delete(
                    $purchaseRequest->reviewer_signature
                );
            }


            if (
                $purchaseRequest->approver_signature &&
                Storage::disk('public')->exists($purchaseRequest->approver_signature)
            ) {
                Storage::disk('public')->delete(
                    $purchaseRequest->approver_signature
                );
            }


            $purchaseRequest->delete();
        });

        return redirect()
            ->route('purchase-requests.index')
            ->with(
                'success',
                'Purchase Request deleted successfully.'
            );
    }


    public function approve(PurchaseRequest $purchaseRequest)
    {
        $user = auth()->user();

        $canApprove = false;

        // Manager can approve if they are the selected reviewer
        if (
            $user->role?->name === 'Manager' &&
            (int) $purchaseRequest->reviewed_by === (int) $user->id
        ) {
            $canApprove = true;
        }

        // ED can approve if they are the selected approver
        if (
            $user->role?->name === 'ED' &&
            (int) $purchaseRequest->approved_by === (int) $user->id
        ) {
            $canApprove = true;
        }

        if (!$canApprove) {
            abort(403, 'You are not authorized to approve this Purchase Request.');
        }


        $purchaseRequest->update([

            'status' => 'Approval',

            'reviewed_at' => $user->role?->name === 'Manager'
                ? now()
                : $purchaseRequest->reviewed_at,

            'approved_at' => $user->role?->name === 'ED'
                ? now()
                : $purchaseRequest->approved_at,

        ]);


        $purchaseRequest->load([
            'preparer',
            'reviewer',
            'approver',
            'items',
        ]);


        $financeUsers = User::with('role')
            ->whereHas('role', function ($query) {

                $query->where('name', 'Finance');
            })
            ->whereNotNull('email')
            ->get();


        foreach ($financeUsers as $finance) {

            Mail::to($finance->email)->send(

                new PurchaseRequestNotification(
                    $purchaseRequest,
                    $finance,
                    'finance'
                )

            );
        }


        return redirect()
            ->back()
            ->with(
                'success',
                'Purchase Request approved successfully. Finance has been notified.'
            );
    }


    public function exportPdf(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->load([
            'items',
            'preparer.department',
            'reviewer',
            'approver',
        ]);

        $html = view('purchase-requests.pdf', compact('purchaseRequest'))->render();

        // Replace non-breaking spaces
        $html = str_replace("\xc2\xa0", ' ', $html);

        try {

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_left'   => 6,
                'margin_right'  => 6,
                'margin_top'    => 6,
                'margin_bottom' => 6,
                'margin_header' => 3,
                'margin_footer' => 3,
                'autoScriptToLang' => true,
                'autoLangToFont'   => true,
                'tempDir' => storage_path('app/mpdf'),
            ]);

            $mpdf->SetTitle('Purchase Request');

            $mpdf->SetAuthor(config('app.name'));

            $mpdf->SetDisplayMode('fullpage');

            // Watermark
            $logo = public_path('images/logo.png');

            if (file_exists($logo)) {

                $mpdf->SetWatermarkImage(
                    $logo,
                    0.05,
                    [120, 100],
                    [45, 70]
                );

                $mpdf->showWatermarkImage = true;
            }

            $mpdf->WriteHTML(
                $html,
                HTMLParserMode::DEFAULT_MODE
            );

            return response(
                $mpdf->Output(
                    'Purchase_Request_' . $purchaseRequest->purchase_no . '.pdf',
                    \Mpdf\Output\Destination::STRING_RETURN
                ),
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="Purchase_Request_' . $purchaseRequest->purchase_no . '.pdf"',
                ]
            );
        } catch (\Throwable $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ], 500);
        }
    }


    public function templatePdf()
    {
        $html = view(
            'purchase-requests.template'
        )->render();

        // Remove non-breaking spaces
        $html = str_replace("\xc2\xa0", ' ', $html);

        try {

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',

                'margin_left'   => 6,
                'margin_right'  => 6,
                'margin_top'    => 6,
                'margin_bottom' => 6,

                'margin_header' => 3,
                'margin_footer' => 3,

                'autoScriptToLang' => true,
                'autoLangToFont'   => true,

                'tempDir' => storage_path('app/mpdf'),
            ]);

            $mpdf->SetTitle(
                'Purchase Request Template - FM02-04'
            );

            $mpdf->SetAuthor(
                config('app.name')
            );

            $mpdf->SetDisplayMode('fullpage');

            $logo = public_path('images/logo.png');

            if (file_exists($logo)) {

                $mpdf->SetWatermarkImage(
                    $logo,
                    0.05,
                    [120, 100],
                    [45, 70]
                );

                $mpdf->showWatermarkImage = true;
            }


            $mpdf->WriteHTML(
                $html,
                HTMLParserMode::DEFAULT_MODE
            );

            return response(
                $mpdf->Output(
                    'Purchase_Request_FM02-04_Template.pdf',
                    \Mpdf\Output\Destination::STRING_RETURN
                ),
                200,
                [
                    'Content-Type' => 'application/pdf',

                    'Content-Disposition' =>
                    'inline; filename="Purchase_Request_FM02-04_Template.pdf"',
                ]
            );
        } catch (\Throwable $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ], 500);
        }
    }
}
