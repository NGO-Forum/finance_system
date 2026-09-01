<?php

namespace App\Http\Controllers;

use App\Models\ExpenditureSummary;
use Illuminate\Http\Request;
use App\Models\FundRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Mail\ExpenditureSummaryNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\ExpenditureSummaryItemAttachment;
use Barryvdh\DomPDF\Facade\Pdf;
use iio\libmergepdf\Merger;

class ExpenditureSummaryController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $summaries = ExpenditureSummary::with([
            'user',
            'reviewer',
            'fundRequest.department',
            'items'
        ])

            ->when(
                !in_array($user->role?->name, ['Admin', 'Finance']),
                function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }
            )

            ->when($request->search, function ($query) use ($request) {

                $search = $request->search;

                $query->where(function ($q) use ($search) {

                    $q->where('activity', 'like', "%{$search}%")
                        ->orWhere('transaction_type', 'like', "%{$search}%")
                        ->orWhere('payment_type', 'like', "%{$search}%")
                        ->orWhere('date', 'like', "%{$search}%")

                        ->orWhereHas('user', function ($user) use ($search) {
                            $user->where(
                                'name',
                                'like',
                                "%{$search}%"
                            );
                        })

                        ->orWhereHas('reviewer', function ($reviewer) use ($search) {
                            $reviewer->where(
                                'name',
                                'like',
                                "%{$search}%"
                            );
                        })

                        ->orWhereHas('fundRequest', function ($fund) use ($search) {
                            $fund->where(
                                'title',
                                'like',
                                "%{$search}%"
                            );
                        })

                        ->orWhereHas('fundRequest.department', function ($department) use ($search) {
                            $department->where(
                                'name',
                                'like',
                                "%{$search}%"
                            );
                        });
                });
            })

            ->latest()
            ->paginate(10);

        return view(
            'expenditure-summaries.index',
            compact('summaries')
        );
    }

    public function create()
    {
        $user = auth()->user();

        $fundRequests = FundRequest::with([
            'department',
            'user',
            'items',
        ])
            ->where('status', 'Approved')
            ->whereDoesntHave('expenditureSummary')
            ->when(
                !in_array($user->role?->name, ['Admin', 'Finance']),
                function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                }
            )
            ->latest()
            ->get();

        // Managers
        $managers = User::with('department', 'role')
            ->whereHas('role', function ($q) {
                $q->where('name', 'Manager');
            })
            ->get();

        // Final Approvers (Manager + Executive Director)
        $approvers = User::with('role')
            ->whereHas('role', function ($q) {
                $q->whereIn('name', [
                    'Manager',
                    'ED'
                ]);
            })
            ->get();

        // Executive Directors
        $eds = User::with('role')
            ->whereHas('role', function ($q) {
                $q->where('name', 'Executive Director');
            })
            ->get();

        return view(
            'expenditure-summaries.create',
            compact(
                'fundRequests',
                'managers',
                'approvers',
                'eds'
            )
        );
    }

    public function store(Request $request)
    {

        $request->validate([
            'fund_request_id' => 'nullable|exists:fund_requests,id',

            'activity' => 'required|string|max:255',
            'date' => 'required|date',
            'place' => 'nullable|string|max:255',

            'transaction_type' => 'required|string',
            'payment_type' => 'nullable|string',

            'advance_voucher_no' => 'nullable|string|max:255',
            'advance_date' => 'nullable|date',

            'variance_required' => 'required|boolean',
            'variance_explanation' => 'nullable|string',

            'late_liquidation' => 'required|boolean',
            'late_liquidation_explanation' => 'nullable|string',

            'prepared_signature' => 'nullable|string',
            'prepared_signature_upload' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'description' => 'required|array|min:1',
            'description.*' => 'required|string',

            'av_amount' => 'nullable|array',
            'av_amount.*' => 'nullable|numeric|min:0',

            'actual_expense' => 'required|array',
            'actual_expense.*' => 'required|numeric|min:0',

            'budget_code.*' => 'nullable|string',
            'donor.*' => 'nullable|string',
            'donor_code.*' => 'nullable|string',

            'attachments' => 'nullable|array',
            'attachments.*' => 'nullable|array',
            'attachments.*.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

            // Requester selects both
            'reviewed_by' => 'required|exists:users,id',
            'approved_by' => 'required|exists:users,id',
        ]);


        $preparedSignature = null;

        if ($request->filled('prepared_signature')) {

            $image = str_replace(
                'data:image/png;base64,',
                '',
                $request->prepared_signature
            );

            $image = str_replace(' ', '+', $image);

            $fileName =
                'prepared-signatures/' .
                uniqid() .
                '.png';

            Storage::disk('public')->put(
                $fileName,
                base64_decode($image)
            );

            $preparedSignature = $fileName;
        }

        if ($request->hasFile('prepared_signature_upload')) {

            $preparedSignature =
                $request->file('prepared_signature_upload')
                ->store(
                    'prepared-signatures',
                    'public'
                );
        }
        try {
            DB::transaction(function () use (
                $request,
                $preparedSignature
            ) {


                $summary = ExpenditureSummary::create([

                    'fund_request_id' => $request->fund_request_id,

                    'activity' => $request->activity,
                    'date' => $request->date,
                    'place' => $request->place,

                    'transaction_type' => $request->transaction_type,
                    'payment_type' => $request->payment_type,

                    'advance_voucher_no' => $request->advance_voucher_no,
                    'advance_date' => $request->advance_date,

                    'variance_required' => $request->variance_required,
                    'variance_explanation' => $request->variance_explanation,

                    'late_liquidation' => $request->late_liquidation,
                    'late_liquidation_explanation' => $request->late_liquidation_explanation,

                    'prepared_signature' => $preparedSignature,

                    // Selected users
                    'reviewed_by' => $request->reviewed_by,
                    'approved_by' => $request->approved_by,

                    'status' => 'Pending Manager Approval',

                    'user_id' => auth()->id(),
                ]);


                foreach ($request->description as $index => $description) {

                    $av = $request->av_amount[$index] ?? 0;

                    $actual = $request->actual_expense[$index] ?? 0;

                    // Variance
                    $variance = $av - $actual;

                    // Variance Percent
                    if ($av > 0) {

                        $percent = round(
                            ($variance / $av) * 100,
                            2
                        );
                    } elseif ($actual > 0) {

                        $percent = -100;
                    } else {

                        $percent = 0;
                    }

                    $item = $summary->items()->create([

                        'description' => $description,

                        'av_amount' => $av,

                        'actual_expense' => $actual,

                        'variance_amount' => $variance,

                        'variance_percent' => $percent,

                        'budget_code' => $request->budget_code[$index] ?? null,

                        'donor' => $request->donor[$index] ?? null,

                        'donor_code' => $request->donor_code[$index] ?? null,
                    ]);

                    if (isset($request->file('attachments')[$index])) {

                        foreach ($request->file('attachments')[$index] as $file) {

                            $path = $file->store(
                                'expenditure-summary-attachments',
                                'public'
                            );

                            $item->attachments()->create([

                                'file' => $path,

                                'original_name' =>
                                $file->getClientOriginalName(),

                            ]);
                        }
                    }
                }

                $reviewer = User::find($summary->reviewed_by);

                if ($reviewer && $reviewer->email) {

                    Mail::to($reviewer->email)->send(
                        new ExpenditureSummaryNotification(
                            $summary,
                            $reviewer,
                            'reviewer'
                        )
                    );
                }
            });
        } catch (\Exception $e) {

            dd($e->getMessage());
        }

        return redirect()
            ->route('expenditure-summaries.index')
            ->with(
                'success',
                'Expenditure Summary created successfully.'
            );
    }

    public function show(
        ExpenditureSummary $expenditureSummary
    ) {

        $expenditureSummary->load([
            'user',
            'fundRequest',
            'items.attachments'
        ]);

        return view(
            'expenditure-summaries.show',
            compact('expenditureSummary')
        );
    }

    public function edit(
        ExpenditureSummary $expenditureSummary
    ) {
        $expenditureSummary->load('items');

        $fundRequests = FundRequest::all();

        return view(
            'expenditure-summaries.edit',
            compact(
                'expenditureSummary',
                'fundRequests'
            )
        );
    }

    public function update(
        Request $request,
        ExpenditureSummary $expenditureSummary
    ) {

        $request->validate([

            'activity' => 'required|string|max:255',

            'date' => 'required|date',

            'transaction_type' => 'required|string',

            'description' => 'required|array|min:1',

            'description.*' => 'required|string',

            'attachments.*.*' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],
        ]);

        DB::transaction(function () use (
            $request,
            $expenditureSummary
        ) {

            $expenditureSummary->update([

                'activity' =>
                $request->activity,

                'date' =>
                $request->date,

                'place' =>
                $request->place,

                'transaction_type' =>
                $request->transaction_type,

                'payment_type' =>
                $request->payment_type,

                'advance_voucher_no' =>
                $request->advance_voucher_no,

                'advance_date' =>
                $request->advance_date,

                'variance_required' =>
                (bool) $request->variance_required,

                'variance_explanation' =>
                $request->variance_required
                    ? $request->variance_explanation
                    : null,

                'late_liquidation' =>
                (bool) $request->late_liquidation,

                'late_liquidation_explanation' =>
                $request->late_liquidation
                    ? $request->late_liquidation_explanation
                    : null,
            ]);

            // Delete old items + attachments
            $expenditureSummary
                ->items()
                ->each(function ($item) {

                    foreach ($item->attachments as $attachment) {

                        Storage::disk('public')
                            ->delete($attachment->file);
                    }

                    $item->delete();
                });

            foreach (
                $request->description as $index => $description
            ) {

                $av = $request->av_amount[$index] ?? 0;

                $actual = $request->actual_expense[$index] ?? 0;

                // Variance
                $variance = $av - $actual;

                // Variance Percent
                if ($av > 0) {

                    $percent = round(
                        ($variance / $av) * 100,
                        2
                    );
                } elseif ($actual > 0) {

                    $percent = -100;
                } else {

                    $percent = 0;
                }
                $item =
                    $expenditureSummary
                    ->items()
                    ->create([

                        'description' =>
                        $description,

                        'av_amount' =>
                        $av,

                        'actual_expense' =>
                        $actual,

                        'variance_amount' =>
                        $variance,

                        'variance_percent' =>
                        $percent,

                        'budget_code' =>
                        $request->budget_code[$index] ?? null,

                        'donor' =>
                        $request->donor[$index] ?? null,

                        'donor_code' =>
                        $request->donor_code[$index] ?? null,
                    ]);

                // Upload attachments
                if (isset($request->file('attachments')[$index])) {

                    foreach ($request->file('attachments')[$index] as $file) {

                        $path = $file->store(
                            'expenditure-summary-attachments',
                            'public'
                        );

                        $item->attachments()->create([
                            'file' => $path,
                            'original_name' => $file->getClientOriginalName(),
                        ]);
                    }
                }

                if ($request->filled('delete_attachments')) {

                    foreach ($request->delete_attachments as $attachmentId) {

                        $attachment =
                            ExpenditureSummaryItemAttachment::find($attachmentId);

                        if ($attachment) {

                            Storage::disk('public')
                                ->delete($attachment->file);

                            $attachment->delete();
                        }
                    }
                }
            }
        });

        return redirect()
            ->route(
                'expenditure-summaries.index',
                $expenditureSummary
            )
            ->with(
                'success',
                'Expenditure Summary updated successfully.'
            );
    }

    public function approveByManager(
        Request $request,
        ExpenditureSummary $summary
    ) {

        // Save drawn signature
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

            $summary->reviewer_signature = $fileName;
        }

        // Save uploaded signature
        if ($request->hasFile('reviewer_signature_upload')) {

            $summary->reviewer_signature = $request
                ->file('reviewer_signature_upload')
                ->store(
                    'reviewer-signatures',
                    'public'
                );
        }

        // Do NOT overwrite reviewed_by
        // It already stores the selected reviewer.

        $summary->reviewed_at = now();

        $summary->status = 'Pending ED Approval';

        $summary->save();

        // Send email to selected approver
        $approver = User::find($summary->approved_by);

        if ($approver && $approver->email) {

            Mail::to($approver->email)->send(
                new ExpenditureSummaryNotification(
                    $summary,
                    $approver,
                    'approver'
                )
            );
        }

        return back()->with(
            'success',
            'Expenditure Summary has been reviewed and sent for final approval.'
        );
    }

    public function approveByED(
        Request $request,
        ExpenditureSummary $summary
    ) {

        // Save drawn signature
        if ($request->filled('approved_signature')) {

            $image = str_replace(
                'data:image/png;base64,',
                '',
                $request->approved_signature
            );

            $image = str_replace(' ', '+', $image);

            $fileName =
                'approved-signatures/' .
                uniqid() .
                '.png';

            Storage::disk('public')->put(
                $fileName,
                base64_decode($image)
            );

            $summary->approved_signature = $fileName;
        }

        // Save uploaded signature
        if ($request->hasFile('approved_signature_upload')) {

            $summary->approved_signature =
                $request->file('approved_signature_upload')
                ->store(
                    'approved-signatures',
                    'public'
                );
        }

        // Do NOT overwrite approved_by
        // It already stores the selected approver.

        $summary->approved_at = now();

        $summary->status = 'Approved';

        $summary->save();

        // Notify Finance
        $finances = User::active()
            ->whereHas('role', function ($query) {
                $query->where('name', 'Finance');
            })
            ->get();

        foreach ($finances as $finance) {

            if ($finance->email) {

                Mail::to($finance->email)->send(
                    new ExpenditureSummaryNotification(
                        $summary,
                        $finance,
                        'finance'
                    )
                );
            }
        }

        // Notify Requester
        if ($summary->user && $summary->user->email) {

            Mail::to($summary->user->email)->send(
                new ExpenditureSummaryNotification(
                    $summary,
                    $summary->user,
                    'requester'
                )
            );
        }

        return back()->with(
            'success',
            'Expenditure Summary approved successfully.'
        );
    }

    public function destroy(
        ExpenditureSummary $expenditureSummary
    ) {
        $expenditureSummary->delete();

        return redirect()
            ->route(
                'expenditure-summaries.index'
            )
            ->with(
                'success',
                'Deleted successfully.'
            );
    }


    public function exportPdf(ExpenditureSummary $summary)
    {
        $summary->load([
            'items.attachments',
            'user',
            'reviewer',
            'fundRequest',
        ]);

        // Array to track temporary files we need to delete later
        $tempFilesToDelete = [];

        // 1. Generate core summary PDF
        $pdf = Pdf::loadView(
            'expenditure-summaries.pdf',
            compact('summary')
        )->setPaper('a4', 'landscape');

        $tempFile = storage_path(
            'app/temp/expenditure-summary-' . $summary->id . '.pdf'
        );

        if (!file_exists(dirname($tempFile))) {
            mkdir(dirname($tempFile), 0755, true);
        }

        file_put_contents($tempFile, $pdf->output());
        $tempFilesToDelete[] = $tempFile;

        $merger = new Merger();

        // Add Page 1 (The main expenditure summary)
        $merger->addFile($tempFile);

        // 2. Loop through all items and append supporting documents
        foreach ($summary->items as $item) {
            foreach ($item->attachments as $attachment) {
                $path = storage_path('app/public/' . $attachment->file);

                if (!file_exists($path)) {
                    continue;
                }

                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

                // Merge uploaded PDFs directly
                if ($extension === 'pdf') {
                    $merger->addFile($path);
                }
                // Convert images to temporary PDFs, then merge
                elseif (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    // Get image data to embed into a minimal HTML wrapper
                    $imageData = base64_encode(file_get_contents($path));
                    $src = 'data:image/' . $extension . ';base64,' . $imageData;

                    // Construct a basic standalone HTML template for the image
                    $html = '
                <!DOCTYPE html>
                <html>
                <head>
                    <style>
                        @page { margin: 0px; }
                        body { margin: 0px; text-align: center; background-color: #ffffff; }
                        img { max-width: 100%; max-height: 100%; object-fit: contain; }
                    </style>
                </head>
                <body>
                    <img src="' . $src . '">
                </body>
                </html>';

                    // Use DOMPDF to build the temporary PDF page for this image
                    $imagePdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

                    $imgTempPath = storage_path(
                        'app/temp/img-attachment-' . uniqid() . '.pdf'
                    );

                    file_put_contents($imgTempPath, $imagePdf->output());

                    // Queue for merging and cleanup
                    $merger->addFile($imgTempPath);
                    $tempFilesToDelete[] = $imgTempPath;
                }
            }
        }

        // 3. Compile and generate final merged response
        $createdPdf = $merger->merge();

        // 4. Clean up temporary files on server
        foreach ($tempFilesToDelete as $file) {
            if (file_exists($file)) {
                @unlink($file);
            }
        }

        return response(
            $createdPdf,
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="Expenditure-Summary-' . $summary->id . '.pdf"',
            ]
        );
    }


    public function templatePdf()
    {
        $pdf = Pdf::loadView(
            'expenditure-summaries.template'
        );

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream(
            'Expenditure-Summary-FM02-03-Template.pdf'
        );
    }
}
