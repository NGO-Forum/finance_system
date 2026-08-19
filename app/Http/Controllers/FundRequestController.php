<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\FundRequest;
use App\Models\FundRequestItem;
use App\Mail\FundRequestNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Mail\FundRequestApprovedNotification;
use App\Mail\FundRequestRejectedNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use iio\libmergepdf\Merger;
use App\Models\DonorLogo;

class FundRequestController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $fundRequests = FundRequest::with([
            'user',
            'department',
            'reviewer',
            'agendas',
        ])

            ->when(true, function ($query) use ($user) {

                if (in_array($user->role?->name, ['Admin', 'Finance'])) {

                    // See all
                } else {

                    $query->where(
                        'user_id',
                        $user->id
                    );
                }
            })

            ->when($request->search, function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    // Title 
                    $q->where('title', 'like', "%{$search}%")
                        // Status 
                        ->orWhere('status', 'like', "%{$search}%")
                        // Request Date 
                        ->orWhere('request_date', 'like', "%{$search}%")
                        // User Name 
                        ->orWhereHas('user', function ($user) use ($search) {
                            $user->where('name', 'like', "%{$search}%");
                        })
                        // Department 
                        ->orWhereHas('department', function ($department) use ($search) {
                            $department->where('name', 'like', "%{$search}%");
                        })
                        // Reviewer 
                        ->orWhereHas('reviewer', function ($reviewer) use ($search) {
                            $reviewer->where('name', 'like', "%{$search}%");
                        });
                });
            })

            ->latest()
            ->paginate(10);

        return view(
            'fund-requests.index',
            compact('fundRequests')
        );
    }

    public function create()
    {
        $donors = DonorLogo::orderBy('name')->get();

        $managers = User::whereHas('role', function ($q) {
            $q->where('name', 'Manager');
        })->get();

        $eds = User::whereHas('role', function ($q) {
            $q->where('name', 'ED');
        })->get();

        $approvers = User::whereHas('role', function ($q) {
            $q->whereIn('name', ['Manager', 'ED']);
        })->get();

        return view(
            'fund-requests.create',
            compact(
                'donors',
                'managers',
                'eds',
                'approvers'
            )
        );
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'title' => 'required|string|max:255',
            'request_date' => 'required|date',
            'place' => 'nullable|string|max:255',

            'description.*' => 'required|string',
            'quantity.*' => 'required|numeric|min:1',
            'cost.*' => 'required|numeric|min:0',
            'time.*' => 'required|numeric|min:1',

            'requester_signature' => 'nullable|string',
            'requester_signature_upload' => 'nullable|image|max:2048',

            'agenda_activity' => 'nullable|array',
            'agenda_activity.*' => 'nullable|string',

            'agenda_start_time.*' => 'nullable|date_format:H:i',
            'agenda_end_time.*' => 'nullable|date_format:H:i',

            'agenda_responsible_person.*' => 'nullable|string',

            'agenda_remarks.*' => 'nullable|string',

            'donor_logo_ids' => 'nullable|array',
            'donor_logo_ids.*' => 'exists:donor_logos,id',

            'reviewed_by' => $user->role->name != 'Manager'
                ? 'required|exists:users,id'
                : 'nullable',

            'approved_by' => $user->role->name == 'Manager'
                ? 'nullable'
                : 'required|exists:users,id',
        ]);

        DB::beginTransaction();

        try {

            $signature = null;

            // Canvas Signature
            if ($request->filled('requester_signature')) {

                $image = str_replace(
                    'data:image/png;base64,',
                    '',
                    $request->requester_signature
                );

                $image = str_replace(' ', '+', $image);

                $fileName =
                    'fund_requests/signatures/' .
                    uniqid() .
                    '.png';

                Storage::disk('public')->put(
                    $fileName,
                    base64_decode($image)
                );

                $signature = $fileName;
            }

            // Upload Signature
            if ($request->hasFile('requester_signature_upload')) {

                $signature = $request
                    ->file('requester_signature_upload')
                    ->store(
                        'fund_requests/signatures',
                        'public'
                    );
            }

            if ($user->role->name === 'Manager') {

                $status = 'Pending ED Approval';

                $reviewedBy = null;

                $ed = User::whereHas('role', function ($q) {
                    $q->where('name', 'ED');
                })->first();

                if (!$ed) {
                    throw new \Exception('Executive Director (ED) account not found.');
                }

                $approvedBy = $ed->id;
            } else {

                $status = 'Pending Manager Approval';

                $reviewedBy = $request->reviewed_by;

                $approvedBy = $request->approved_by;
            }

            $fundRequest = FundRequest::create([
                'title' => $request->title,
                'request_date' => $request->request_date,
                'place' => $request->place,
                'fund_by' => $request->fund_by,
                'objectives' => $request->objectives,
                'rationale' => $request->rationale,
                'expectation' => $request->expectation,
                'participant_list' => $request->participant_list,
                'reviewed_by' => $reviewedBy,
                'approved_by' => $approvedBy,
                'status' => $status,
                'requester_signature' => $signature,
                'user_id' => auth()->id(),
                'department_id' => auth()->user()->department_id,
                'status' => $status,
            ]);

            $fundRequest->donorLogos()->sync(
                $request->donor_logo_ids ?? []
            );

            $totalBudget = 0;

            foreach ($request->description as $index => $description) {

                $quantity = $request->quantity[$index] ?? 0;
                $cost = $request->cost[$index] ?? 0;
                $time = $request->time[$index] ?? 0;

                $budget = $quantity * $cost * $time;

                $fundRequest->items()->create([
                    'description' => $description,
                    'quantity' => $quantity,
                    'cost' => $cost,
                    'time' => $time,
                    'budget' => $budget,
                    'budget_code' => $request->budget_code[$index] ?? null,
                    'donor_code' => $request->donor_code[$index] ?? null,
                    'donor' => $request->donor[$index] ?? null,
                    'remarks' => $request->remarks[$index] ?? null,
                ]);

                $totalBudget += $budget;
            }

            $fundRequest->update([
                'total_budget' => $totalBudget
            ]);

            if ($request->filled('agenda_activity')) {

                foreach ($request->agenda_activity as $index => $activity) {

                    if (empty($activity)) {
                        continue;
                    }

                    $fundRequest->agendas()->create([

                        'start_time' =>
                        $request->agenda_start_time[$index] ?? null,

                        'end_time' =>
                        $request->agenda_end_time[$index] ?? null,

                        'activity' =>
                        $activity,

                        'responsible_person' =>
                        $request->agenda_responsible_person[$index] ?? null,

                        'remarks' =>
                        $request->agenda_remarks[$index] ?? null,
                    ]);
                }
            }

            DB::commit();

            // Notify reviewer only
            if ($fundRequest->reviewer) {

                Mail::to($fundRequest->reviewer->email)
                    ->send(
                        new FundRequestNotification(
                            $fundRequest,
                            $fundRequest->reviewer,
                            'reviewer'
                        )
                    );
            }

            return redirect()
                ->route('fund-requests.index')
                ->with('success', 'Fund Request created successfully.');
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }

    public function show(FundRequest $fundRequest)
    {
        $user = auth()->user();

        $role = $user->role?->name;

        $canView = false;

        // Admin & Finance
        if (in_array($role, ['Admin', 'Finance'])) {

            $canView = true;
        }

        // Manager of same department
        elseif (
            $role == 'Manager' &&
            $user->department_id == $fundRequest->department_id
        ) {

            $canView = true;
        }

        // ED can view all
        elseif ($role == 'ED') {

            $canView = true;
        }

        // Request owner
        elseif ($fundRequest->user_id == $user->id) {

            $canView = true;
        }

        abort_unless($canView, 403);

        $fundRequest->load([
            'user',
            'department',
            'reviewer',
            'items',
            'agendas',
            'donorLogos',
        ]);

        return view(
            'fund-requests.show',
            compact('fundRequest')
        );
    }

    public function edit(FundRequest $fundRequest)
    {
        $user = auth()->user();
        $role = $user->role?->name;

        $canEdit = false;

        // Request owner
        if ($fundRequest->user_id == $user->id) {
            $canEdit = true;
        }

        // Manager reviewing this request
        elseif (
            $role === 'Manager' &&
            $fundRequest->status === 'Pending Manager Approval' &&
            $user->department_id == $fundRequest->department_id
        ) {
            $canEdit = true;
        }

        // Final approver (ED or assigned approver)
        elseif (
            $user->id == $fundRequest->approved_by &&
            in_array($fundRequest->status, [
                'Pending ED Approval'
            ])
        ) {
            $canEdit = true;
        }

        // Admin
        elseif ($role === 'Admin') {
            $canEdit = true;
        }

        abort_unless($canEdit, 403);

        $fundRequest->load(['items', 'agendas']);

        $donors = DonorLogo::orderBy('name')->get();

        return view('fund-requests.edit', compact('fundRequest', 'donors'));
    }

    public function update(Request $request, FundRequest $fundRequest)
    {
        $user = auth()->user();
        $role = $user->role?->name;

        $canEdit = false;

        // Request owner
        if ($fundRequest->user_id == $user->id) {
            $canEdit = true;
        }

        // Manager reviewing request
        elseif (
            $role === 'Manager' &&
            $fundRequest->status === 'Pending Manager Approval' &&
            $user->department_id == $fundRequest->department_id
        ) {
            $canEdit = true;
        }

        // Final approver (ED or assigned Manager)
        elseif (
            $user->id == $fundRequest->approved_by &&
            in_array($fundRequest->status, [
                'Pending ED Approval'
            ])
        ) {
            $canEdit = true;
        }

        // Admin
        elseif ($role === 'Admin') {
            $canEdit = true;
        }

        abort_unless($canEdit, 403, 'Unauthorized');

        $request->validate([
            'title' => 'required|string|max:255',
            'request_date' => 'required|date',
            'place' => 'nullable|string|max:255',

            'agenda_activity' => 'nullable|array',
            'agenda_activity.*' => 'nullable|string',

            'agenda_start_time.*' => 'nullable|date_format:H:i',
            'agenda_end_time.*' => 'nullable|date_format:H:i',
            'agenda_responsible_person.*' => 'nullable|string',
            'agenda_remarks.*' => 'nullable|string',

            'donor_logo_ids' => 'nullable|array',
            'donor_logo_ids.*' => 'exists:donor_logos,id',
        ]);

        DB::beginTransaction();

        try {

            $data = [
                'title' => $request->title,
                'request_date' => $request->request_date,
                'place' => $request->place,
                'fund_by' => $request->fund_by,
                'rationale' => $request->rationale,
                'objectives' => $request->objectives,
                'expectation' => $request->expectation,
                'participant_list' => $request->participant_list,
            ];

            /*
        |--------------------------------------------------------------------------
        | Only request owner restarts approval workflow
        |--------------------------------------------------------------------------
        */
            if ($fundRequest->user_id == $user->id) {

                $data['status'] = 'Pending';

                $data['reviewed_by'] = null;
                $data['reviewed_at'] = null;
                $data['reviewer_signature'] = null;

                $data['approved_at'] = null;
                $data['approved_signature'] = null;
            }

            $fundRequest->update($data);

            /*
        |--------------------------------------------------------------------------
        | Donor Logos
        |--------------------------------------------------------------------------
        */

            $fundRequest->donorLogos()->sync(
                $request->donor_logo_ids ?? []
            );

            /*
        |--------------------------------------------------------------------------
        | Budget Items
        |--------------------------------------------------------------------------
        */

            $fundRequest->items()->delete();

            $totalBudget = 0;

            if ($request->filled('description')) {

                foreach ($request->description as $index => $description) {

                    if (empty($description)) {
                        continue;
                    }

                    $quantity = $request->quantity[$index] ?? 1;
                    $cost = $request->cost[$index] ?? 0;
                    $time = $request->time[$index] ?? 1;

                    $budget = $quantity * $cost * $time;

                    $fundRequest->items()->create([
                        'description' => $description,
                        'quantity' => $quantity,
                        'cost' => $cost,
                        'time' => $time,
                        'budget' => $budget,
                        'budget_code' => $request->budget_code[$index] ?? null,
                        'donor_code' => $request->donor_code[$index] ?? null,
                        'donor' => $request->donor[$index] ?? null,
                        'remarks' => $request->remarks[$index] ?? null,
                    ]);

                    $totalBudget += $budget;
                }
            }

            $fundRequest->update([
                'total_budget' => $totalBudget
            ]);

            /*
        |--------------------------------------------------------------------------
        | Agendas
        |--------------------------------------------------------------------------
        */

            $fundRequest->agendas()->delete();

            if (
                $request->has('agenda_activity') &&
                collect($request->agenda_activity)->filter()->isNotEmpty()
            ) {

                foreach ($request->agenda_activity as $index => $activity) {

                    if (empty($activity)) {
                        continue;
                    }

                    $fundRequest->agendas()->create([
                        'start_time' => $request->agenda_start_time[$index] ?? null,
                        'end_time' => $request->agenda_end_time[$index] ?? null,
                        'activity' => $activity,
                        'responsible_person' => $request->agenda_responsible_person[$index] ?? null,
                        'remarks' => $request->agenda_remarks[$index] ?? null,
                    ]);
                }
            }

            // ===================================================
            // Save & Approve
            // ===================================================
            if ($request->action === 'approve') {

                // ===============================
                // Manager Approval
                // ===============================
                if (
                    $role === 'Manager' &&
                    $fundRequest->status === 'Pending Manager Approval'
                ) {

                    $signature = $fundRequest->reviewer_signature;

                    // Canvas Signature
                    if ($request->filled('reviewer_signature')) {

                        $image = str_replace(
                            'data:image/png;base64,',
                            '',
                            $request->reviewer_signature
                        );

                        $image = str_replace(' ', '+', $image);

                        $fileName = 'reviewer-signatures/' . uniqid() . '.png';

                        Storage::disk('public')->put(
                            $fileName,
                            base64_decode($image)
                        );

                        $signature = $fileName;
                    }

                    // Upload Signature
                    if ($request->hasFile('reviewer_signature_upload')) {

                        $signature = $request
                            ->file('reviewer_signature_upload')
                            ->store(
                                'reviewer-signatures',
                                'public'
                            );
                    }

                    $fundRequest->update([
                        'reviewed_by' => auth()->id(),
                        'reviewed_at' => now(),
                        'reviewer_signature' => $signature,
                        'status' => 'Pending ED Approval',
                    ]);

                    $approver = User::find($fundRequest->approved_by);

                    if ($approver) {

                        Mail::to($approver->email)
                            ->send(
                                new FundRequestNotification(
                                    $fundRequest,
                                    $approver,
                                    'approver'
                                )
                            );
                    }
                }

                // ===============================
                // ED Approval
                // ===============================
                elseif (
                    auth()->id() == $fundRequest->approved_by &&
                    $fundRequest->status == 'Pending ED Approval'
                ) {

                    $signature = $fundRequest->approved_signature;

                    if ($request->filled('approved_signature')) {

                        $image = str_replace(
                            'data:image/png;base64,',
                            '',
                            $request->approved_signature
                        );

                        $image = str_replace(' ', '+', $image);

                        $fileName = 'approved-signatures/' . uniqid() . '.png';

                        Storage::disk('public')->put(
                            $fileName,
                            base64_decode($image)
                        );

                        $signature = $fileName;
                    }

                    if ($request->hasFile('approved_signature_upload')) {

                        $signature = $request
                            ->file('approved_signature_upload')
                            ->store(
                                'approved-signatures',
                                'public'
                            );
                    }

                    $fundRequest->update([
                        'approved_by' => auth()->id(),
                        'approved_at' => now(),
                        'approved_signature' => $signature,
                        'status' => 'Approved',
                    ]);

                    $finances = User::active()
                        ->whereHas('role', function ($q) {
                            $q->where('name', 'Finance');
                        })
                        ->get();

                    foreach ($finances as $finance) {

                        Mail::to($finance->email)
                            ->send(
                                new FundRequestApprovedNotification(
                                    $fundRequest,
                                    'finance'
                                )
                            );
                    }

                    Mail::to($fundRequest->user->email)
                        ->send(
                            new FundRequestApprovedNotification(
                                $fundRequest,
                                'requester'
                            )
                        );
                }
            }

            DB::commit();

            return redirect()
                ->route('fund-requests.index')
                ->with(
                    'success',
                    $request->action === 'approve'
                        ? 'Fund Request updated and approved successfully.'
                        : 'Fund Request updated successfully.'
                );
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );
        }
    }


    public function approveByManager(
        Request $request,
        FundRequest $fundRequest
    ) {

        $request->validate([
            'reviewer_signature' => 'nullable|string',
            'reviewer_signature_upload' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {

            $signature = $fundRequest->reviewer_signature;

            // Canvas Signature
            if ($request->filled('reviewer_signature')) {

                $image = str_replace(
                    'data:image/png;base64,',
                    '',
                    $request->reviewer_signature
                );

                $image = str_replace(' ', '+', $image);

                $fileName = 'reviewer-signatures/' . uniqid() . '.png';

                Storage::disk('public')->put(
                    $fileName,
                    base64_decode($image)
                );

                $signature = $fileName;
            }

            // Upload Signature
            if ($request->hasFile('reviewer_signature_upload')) {

                $signature = $request
                    ->file('reviewer_signature_upload')
                    ->store(
                        'reviewer-signatures',
                        'public'
                    );
            }

            // Save Manager Review
            $fundRequest->reviewer_signature = $signature;
            $fundRequest->reviewed_by = auth()->id();
            $fundRequest->reviewed_at = now();
            $fundRequest->status = 'Pending ED Approval';

            $fundRequest->save();

            // Get selected approver
            $approver = User::find($fundRequest->approved_by);

            if (!$approver) {

                DB::rollBack();

                return back()->with(
                    'error',
                    'Approver not found.'
                );
            }

            // Send email ONLY to selected approver
            Mail::to($approver->email)
                ->send(
                    new FundRequestNotification(
                        $fundRequest,
                        $approver,
                        'approver'
                    )
                );

            DB::commit();

            return back()->with(
                'success',
                'Fund Request forwarded to ' . $approver->name . ' successfully.'
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function approveByED(
        Request $request,
        FundRequest $fundRequest
    ) {

        DB::beginTransaction();

        try {

            $signature = null;

            // Canvas Signature
            if ($request->filled('approved_signature')) {

                $image = str_replace(
                    'data:image/png;base64,',
                    '',
                    $request->approved_signature
                );

                $image = str_replace(' ', '+', $image);

                $fileName = 'approved-signatures/' . uniqid() . '.png';

                Storage::disk('public')->put(
                    $fileName,
                    base64_decode($image)
                );

                $signature = $fileName;
            }

            // Upload Signature
            if ($request->hasFile('approved_signature_upload')) {

                $signature = $request
                    ->file('approved_signature_upload')
                    ->store(
                        'approved-signatures',
                        'public'
                    );
            }

            // Final Approval
            $fundRequest->update([
                'approved_by'        => auth()->id(),
                'approved_signature' => $signature,
                'approved_at'        => now(),
                'status'             => 'Approved',
            ]);

            // Notify Finance
            $finances = User::active()
                ->whereHas('role', function ($query) {
                    $query->where('name', 'Finance');
                })
                ->get();

            foreach ($finances as $finance) {

                Mail::to($finance->email)
                    ->send(new FundRequestApprovedNotification($fundRequest, 'finance'));
            }

            // Notify Requester
            Mail::to($fundRequest->user->email)
                ->send(new FundRequestApprovedNotification($fundRequest, 'requester'));

            DB::commit();

            return back()->with(
                'success',
                'Fund Request approved successfully.'
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }


    public function reject(Request $request, FundRequest $fundRequest)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        DB::beginTransaction();

        try {

            $fundRequest->update([
                'status' => 'Rejected',
                'rejection_reason' => $request->rejection_reason,
                'reviewed_by' => auth()->id(),
            ]);

            // Notify requester
            Mail::to($fundRequest->user->email)
                ->send(
                    new FundRequestRejectedNotification(
                        $fundRequest
                    )
                );

            DB::commit();

            return back()->with(
                'success',
                'Fund Request rejected successfully.'
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }


    public function destroy(FundRequest $fundRequest)
    {
        $fundRequest->delete();

        return redirect()
            ->route('fund-requests.index')
            ->with('success', 'Fund Request deleted successfully.');
    }

    public function exportPdf(FundRequest $fundRequest)
    {
        $fundRequest->load([
            'user',
            'department',
            'items',
            'reviewer',
            'agendas',
            'donorLogos',
        ]);

        $pdf = Pdf::loadView(
            'fund-requests.pdf',
            compact('fundRequest')
        );

        return $pdf->stream(
            'Fund-Request-' .
                $fundRequest->id .
                '.pdf'
        );
    }

    // public function exportPdf(FundRequest $fundRequest)
    // {
    //     $fundRequest->load([
    //         'user',
    //         'department',
    //         'items',
    //         'reviewer'
    //     ]);

    //     // Generate Fund Request PDF
    //     $pdf = Pdf::loadView(
    //         'fund-requests.pdf',
    //         compact('fundRequest')
    //     );

    //     $tempFile =
    //         storage_path(
    //             'app/temp/fund-request-' .
    //                 $fundRequest->id .
    //                 '.pdf'
    //         );

    //     if (!file_exists(dirname($tempFile))) {
    //         mkdir(
    //             dirname($tempFile),
    //             0755,
    //             true
    //         );
    //     }

    //     file_put_contents(
    //         $tempFile,
    //         $pdf->output()
    //     );

    //     // No agenda file
    //     if (
    //         !$fundRequest->agenda_file ||
    //         !file_exists(
    //             storage_path(
    //                 'app/public/' .
    //                     $fundRequest->agenda_file
    //             )
    //         )
    //     ) {
    //         return response()->file(
    //             $tempFile
    //         );
    //     }

    //     // Merge PDFs
    //     $merger = new Merger();

    //     $merger->addFile($tempFile);

    //     $merger->addFile(
    //         storage_path(
    //             'app/public/' .
    //                 $fundRequest->agenda_file
    //         )
    //     );

    //     $createdPdf = $merger->merge();

    //     return response(
    //         $createdPdf,
    //         200,
    //         [
    //             'Content-Type' => 'application/pdf',
    //             'Content-Disposition' =>
    //             'inline; filename="Fund-Request-' .
    //                 $fundRequest->id .
    //                 '.pdf"',
    //         ]
    //     );
    // }
}
