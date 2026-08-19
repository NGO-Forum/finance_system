<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\QuotationAnalysis;
use App\Models\QuotationAnalysisScore;
use App\Models\QuotationAnalysisSupplier;
use App\Models\QuotationAnalysisCriterion;
use App\Models\QuotationAnalysisCommittee;

use Mpdf\Mpdf;
use Mpdf\HTMLParserMode;
use Mpdf\Output\Destination;

class QuotationAnalysisController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $query = QuotationAnalysis::with([
            'creator',
            'recommendedSupplier'
        ]);

        if (auth()->user()->role != 'Admin') {

            $query->where('created_by', auth()->id());
        }

        if ($search) {

            $query->where(function ($q) use ($search) {

                $q->where('qa_no', 'like', "%{$search}%")
                    ->orWhere('item_name', 'like', "%{$search}%");
            });
        }

        $quotationAnalyses = $query
            ->latest()
            ->paginate(10);

        return view(
            'quotation-analyses.index',
            compact(
                'quotationAnalyses',
                'search'
            )
        );
    }


    public function create()
    {
        $users = User::orderBy('name')->get();

        $criteria = QuotationAnalysisCriterion::orderBy('sort_order')->get();

        $qaNo = $this->generateQaNumber();

        return view('quotation-analyses.create', compact(
            'users',
            'criteria',
            'qaNo'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([

            'qa_date' => 'required|date',

            'item_name' => 'required|string|max:255',

            'quantity' => 'required|numeric|min:1',

            'decision_explanation' => 'nullable|string',

            // Suppliers
            'supplier_name' => 'required|array|min:1',
            'supplier_name.*' => 'required|string|max:255',

            'contact_person.*' => 'nullable|string|max:255',

            'phone.*' => 'nullable|string|max:100',

            // Evaluation
            'description' => 'required|array',
            'score' => 'required|array',

            'description.*' => 'required|array',
            'score.*' => 'required|array',

            'description.*.*' => 'nullable|string',

            'score.*.*' => 'required|integer|min:0|max:3',

            // Committee
            'committee_user.*' => 'nullable|exists:users,id',

            'committee_position.*' => 'nullable|string|max:255',

            'committee_date.*' => 'nullable|date',

        ]);

        try {

            DB::beginTransaction();

            /*
        |--------------------------------------------------------------------------
        | Create Header
        |--------------------------------------------------------------------------
        */

            $quotation = QuotationAnalysis::create([

                'qa_no' => $this->generateQaNumber(),

                'qa_date' => $request->qa_date,

                'item_name' => $request->item_name,

                'quantity' => $request->quantity,

                'decision_explanation' => $request->decision_explanation,

                'created_by' => auth()->id(),

            ]);

            /*
        |--------------------------------------------------------------------------
        | Supplier & Scores
        |--------------------------------------------------------------------------
        */

            $bestSupplier = null;

            $highestScore = -1;

            foreach ($request->supplier_name as $supplierIndex => $supplierName) {

                if (blank($supplierName)) {
                    continue;
                }

                $supplier = QuotationAnalysisSupplier::create([

                    'quotation_analysis_id' => $quotation->id,

                    'supplier_no' => $supplierIndex + 1,

                    'supplier_name' => $supplierName,

                    'contact_person' => $request->contact_person[$supplierIndex] ?? null,

                    'phone' => $request->phone[$supplierIndex] ?? null,

                    'total_score' => 0,

                ]);

                $totalScore = 0;

                if (isset($request->score[$supplierIndex])) {

                    foreach ($request->score[$supplierIndex] as $criterionId => $score) {

                        QuotationAnalysisScore::create([

                            'quotation_analysis_supplier_id' => $supplier->id,

                            'quotation_analysis_criterion_id' => $criterionId,

                            'description' => $request->description[$supplierIndex][$criterionId] ?? null,

                            'score' => $score,

                        ]);

                        $totalScore += (int) $score;
                    }
                }

                $supplier->update([

                    'total_score' => $totalScore,

                ]);

                if ($totalScore > $highestScore) {

                    $highestScore = $totalScore;

                    $bestSupplier = $supplier;
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Committee
        |--------------------------------------------------------------------------
        */

            if ($request->filled('committee_user')) {

                foreach ($request->committee_user as $index => $userId) {

                    if (empty($userId)) {
                        continue;
                    }

                    QuotationAnalysisCommittee::create([

                        'quotation_analysis_id' => $quotation->id,

                        'user_id' => $userId,

                        'position' => $request->committee_position[$index] ?? null,

                        'signed_date' => $request->committee_date[$index] ?? null,

                    ]);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Recommended Supplier
        |--------------------------------------------------------------------------
        */

            if ($bestSupplier) {

                $quotation->update([

                    'recommended_supplier_id' => $bestSupplier->id,

                ]);
            }

            DB::commit();

            return redirect()
                ->route('quotation-analyses.index')
                ->with('success', 'Quotation Analysis created successfully.');
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }


    public function show(QuotationAnalysis $quotationAnalysis)
    {
        $quotationAnalysis->load([
            'creator.department',
            'recommendedSupplier',
            'suppliers.scores.criterion',
            'committees.user',
        ]);

        $criteria = QuotationAnalysisCriterion::orderBy('sort_order')->get();

        return view('quotation-analyses.show', compact(
            'quotationAnalysis',
            'criteria'
        ));
    }


    public function edit(QuotationAnalysis $quotationAnalysis)
    {
        $quotationAnalysis->load([
            'suppliers.scores.criterion',
            'committees.user',
        ]);

        $criteria = QuotationAnalysisCriterion::orderBy('sort_order')->get();

        $users = User::orderBy('name')->get();

        $suppliersData = $quotationAnalysis->suppliers->map(function ($supplier) {

            return [

                'id' => $supplier->id,

                'supplier_no' => $supplier->supplier_no,

                'supplier_name' => $supplier->supplier_name,

                'contact_person' => $supplier->contact_person,

                'phone' => $supplier->phone,

                'total_score' => $supplier->total_score,

                'scores' => $supplier->scores->map(function ($score) {

                    return [

                        'criterion_id' => $score->quotation_analysis_criterion_id,

                        'description' => $score->description,

                        'score' => (int) $score->score,

                    ];
                })->values(),

            ];
        })->values();

        return view(
            'quotation-analyses.edit',
            compact(
                'quotationAnalysis',
                'criteria',
                'users',
                'suppliersData'
            )
        );
    }


    public function update(Request $request, QuotationAnalysis $quotationAnalysis)
    {
        $request->validate([
            'qa_date' => 'required|date',
            'item_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:1',

            'supplier_name.*' => 'required|string|max:255',
            'contact_person.*' => 'nullable|string|max:255',
            'phone.*' => 'nullable|string|max:100',

            'description.*.*' => 'nullable|string',
            'score.*.*' => 'required|integer|min:0|max:3',

            'committee_user.*' => 'nullable|exists:users,id',
            'committee_position.*' => 'nullable|string|max:255',
            'committee_date.*' => 'nullable|date',

            'decision_explanation' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $quotationAnalysis) {

            /*
        |--------------------------------------------------------------------------
        | Update Header
        |--------------------------------------------------------------------------
        */

            $quotationAnalysis->update([
                'qa_date' => $request->qa_date,
                'item_name' => $request->item_name,
                'quantity' => $request->quantity,
                'decision_explanation' => $request->decision_explanation,
            ]);

            /*
        |--------------------------------------------------------------------------
        | Delete Existing Data
        |--------------------------------------------------------------------------
        */

            foreach ($quotationAnalysis->suppliers as $supplier) {
                $supplier->scores()->delete();
            }

            $quotationAnalysis->suppliers()->delete();
            $quotationAnalysis->committees()->delete();

            /*
        |--------------------------------------------------------------------------
        | Save Suppliers & Scores
        |--------------------------------------------------------------------------
        */

            foreach ($request->supplier_name as $supplierIndex => $supplierName) {

                $supplier = $quotationAnalysis->suppliers()->create([

                    'supplier_no'     => $supplierIndex + 1,
                    'supplier_name'   => $supplierName,
                    'contact_person'  => $request->contact_person[$supplierIndex] ?? null,
                    'phone'           => $request->phone[$supplierIndex] ?? null,
                    'total_score'     => 0,

                ]);

                $totalScore = 0;

                foreach (($request->score[$supplierIndex] ?? []) as $criterionId => $score) {

                    $supplier->scores()->create([

                        'quotation_analysis_criterion_id' => $criterionId,
                        'description' => $request->description[$supplierIndex][$criterionId] ?? null,
                        'score' => $score,

                    ]);

                    $totalScore += (int) $score;
                }

                $supplier->update([
                    'total_score' => $totalScore,
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | Save Committee Members
        |--------------------------------------------------------------------------
        */

            if ($request->filled('committee_user')) {

                foreach ($request->committee_user as $index => $userId) {

                    if (empty($userId)) {
                        continue;
                    }

                    $quotationAnalysis->committees()->create([

                        'user_id' => $userId,

                        'position' => $request->committee_position[$index] ?? null,

                        'signed_date' => $request->committee_date[$index] ?? null,

                    ]);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Update Recommended Supplier
        |--------------------------------------------------------------------------
        */

            $recommendedSupplier = $quotationAnalysis
                ->suppliers()
                ->orderByDesc('total_score')
                ->first();

            $quotationAnalysis->update([

                'recommended_supplier_id' => optional($recommendedSupplier)->id,

            ]);
        });

        return redirect()
            ->route('quotation-analyses.index')
            ->with('success', 'Quotation Analysis updated successfully.');
    }


    public function destroy(QuotationAnalysis $quotationAnalysis)
    {
        // Optional authorization: only creator or Admin
        if (
            auth()->user()->role !== 'Admin' &&
            $quotationAnalysis->created_by !== auth()->id()
        ) {
            abort(403, 'Unauthorized action.');
        }

        DB::transaction(function () use ($quotationAnalysis) {

            // Delete scores
            foreach ($quotationAnalysis->suppliers as $supplier) {

                $supplier->scores()->delete();
            }

            // Delete suppliers
            $quotationAnalysis->suppliers()->delete();

            // Delete committee members
            $quotationAnalysis->committees()->delete();

            // Delete header
            $quotationAnalysis->delete();
        });

        return redirect()
            ->route('quotation-analyses.index')
            ->with(
                'success',
                'Quotation Analysis deleted successfully.'
            );
    }



    public function pdf(QuotationAnalysis $quotationAnalysis)
    {
        $quotationAnalysis->load([
            'creator.department',
            'recommendedSupplier',
            'suppliers.scores.criterion',
            'committees.user',
        ]);

        $criteria = QuotationAnalysisCriterion::orderBy('sort_order')->get();

        $html = view(
            'quotation-analyses.pdf',
            compact(
                'quotationAnalysis',
                'criteria'
            )
        )->render();

        // Replace non-breaking spaces
        $html = str_replace("\xc2\xa0", ' ', $html);

        try {

            $mpdf = new Mpdf([

                'mode' => 'utf-8',

                'format' => 'A4-L',

                'margin_left' => 6,

                'margin_right' => 6,

                'margin_top' => 8,

                'margin_bottom' => 6,

                'margin_header' => 5,

                'margin_footer' => 5,

                'autoScriptToLang' => true,

                'autoLangToFont' => true,

                'tempDir' => storage_path('app/mpdf'),

            ]);

            $mpdf->SetTitle(
                'Quotation Analysis Summary'
            );

            $mpdf->SetAuthor(
                config('app.name')
            );

            $mpdf->SetDisplayMode(
                'fullpage'
            );

            /*
            |--------------------------------------------------------------------------
            | Watermark Logo
            |--------------------------------------------------------------------------
            */

            $logo = public_path('images/logo.png');

            if (file_exists($logo)) {

                $mpdf->SetWatermarkImage(

                    $logo,

                    0.05,

                    [150, 100],

                    [70, 40]

                );

                $mpdf->showWatermarkImage = true;

                $mpdf->watermarkImgBehind = true;
            }

            /*
            |--------------------------------------------------------------------------
            | PDF
            |--------------------------------------------------------------------------
            */

            $mpdf->WriteHTML(

                $html,

                HTMLParserMode::DEFAULT_MODE

            );

            return response(

                $mpdf->Output(

                    'Quotation_Analysis_' .
                        $quotationAnalysis->qa_no .
                        '.pdf',

                    Destination::STRING_RETURN

                ),

                200,

                [

                    'Content-Type' => 'application/pdf',

                    'Content-Disposition' =>
                    'inline; filename="Quotation_Analysis_' .
                        $quotationAnalysis->qa_no .
                        '.pdf"',

                ]

            );
        } catch (\Throwable $e) {

            return response()->json([

                'message' => $e->getMessage(),

                'line' => $e->getLine(),

                'file' => $e->getFile(),

            ], 500);
        }
    }


    /**
     * Generate QA Number
     */
    private function generateQaNumber()
    {
        $latest = QuotationAnalysis::latest()->first();

        $number = $latest
            ? ((int) substr($latest->qa_no, -4)) + 1
            : 1;

        return 'QA-' . date('Y') . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
