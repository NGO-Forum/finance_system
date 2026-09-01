<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerbalQuote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;
use Mpdf\HTMLParserMode;
use Mpdf\Output\Destination;


class VerbalQuoteController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $query = VerbalQuote::with([
            'requester',
            'preparer',
        ]);

        // Search
        $query->when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('quote_number', 'like', "%{$search}%")
                    ->orWhere('supplier_name', 'like', "%{$search}%");
            });
        });

        // Role Permission
        if (auth()->user()->role->name !== 'Admin') {
            $query->where('prepared_by', auth()->id());
        }

        $verbalQuotes = $query->latest()->paginate(10);

        return view('verbal-quotes.index', compact(
            'verbalQuotes',
            'search'
        ));
    }


    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('verbal-quotes.create', compact(
            'users'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([

            'quote_date' => 'required|date',

            'requested_by' => 'required|exists:users,id',

            'supplier_name' => 'required|string|max:255',

            'contact_information' => 'nullable|string|max:255',

            'validity_date' => 'nullable|date',

            'contact_date' => 'nullable|date',

            'contact_time' => 'nullable',

            'additional_specifications' => 'nullable|string',

            'prepared_by' => 'nullable|exists:users,id',

            'prepared_date' => 'nullable|date',

            'description.*' => 'required|string',

            'qty.*' => 'required|numeric|min:0',

            'unit_price.*' => 'required|numeric|min:0',

        ]);

        DB::transaction(function () use ($request) {

            // Generate Quote Number
            $last = VerbalQuote::latest('id')->first();

            $nextNumber = $last
                ? ((int) substr($last->quote_no, -5)) + 1
                : 1;

            $quote = VerbalQuote::create([

                'quote_no' => 'VQ-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT),

                'quote_date' => $request->quote_date,

                'requested_by' => $request->requested_by,

                'supplier_name' => $request->supplier_name,

                'contact_information' => $request->contact_information,

                'validity_date' => $request->validity_date,

                'contact_date' => $request->contact_date,

                'contact_time' => $request->contact_time,

                'additional_specifications' => $request->additional_specifications,

                'prepared_by' => $request->prepared_by,

                'prepared_date' => $request->prepared_date,

            ]);

            foreach ($request->description as $index => $description) {

                $qty = $request->qty[$index];

                $unitPrice = $request->unit_price[$index];

                $quote->items()->create([

                    'budget_line' => $request->budget_line[$index] ?? null,

                    'description' => $description,

                    'qty' => $qty,

                    'unit_price' => $unitPrice,

                    'extended_price' => $qty * $unitPrice,

                ]);
            }
        });

        return redirect()
            ->route('verbal-quotes.index')
            ->with('success', 'Verbal Quote created successfully.');
    }


    public function show(VerbalQuote $verbalQuote)
    {
        $verbalQuote->load([
            'requester',
            'preparer',
            'items',
        ]);

        return view('verbal-quotes.show', compact('verbalQuote'));
    }


    public function edit(VerbalQuote $verbalQuote)
    {
        $verbalQuote->load([
            'items',
            'requester',
            'preparer',
        ]);

        $users = User::orderBy('name')->get();

        return view('verbal-quotes.edit', compact(
            'verbalQuote',
            'users'
        ));
    }


    public function update(Request $request, VerbalQuote $verbalQuote)
    {
        $request->validate([

            'quote_date' => 'required|date',

            'requested_by' => 'required|exists:users,id',

            'supplier_name' => 'required|string|max:255',

            'contact_information' => 'nullable|string|max:255',

            'validity_date' => 'nullable|date',

            'contact_date' => 'nullable|date',

            'contact_time' => 'nullable',

            'additional_specifications' => 'nullable|string',

            'prepared_by' => 'nullable|exists:users,id',

            'prepared_date' => 'nullable|date',

            'description.*' => 'required|string',

            'qty.*' => 'required|numeric|min:0',

            'unit_price.*' => 'required|numeric|min:0',

        ]);

        DB::transaction(function () use ($request, $verbalQuote) {

            // Update Header
            $verbalQuote->update([

                'quote_date' => $request->quote_date,

                'requested_by' => $request->requested_by,

                'supplier_name' => $request->supplier_name,

                'contact_information' => $request->contact_information,

                'validity_date' => $request->validity_date,

                'contact_date' => $request->contact_date,

                'contact_time' => $request->contact_time,

                'additional_specifications' => $request->additional_specifications,

                'prepared_by' => $request->prepared_by,

                'prepared_date' => $request->prepared_date,

            ]);

            // Remove old items
            $verbalQuote->items()->delete();

            // Insert new items
            foreach ($request->description as $index => $description) {

                $qty = $request->qty[$index];

                $unitPrice = $request->unit_price[$index];

                $verbalQuote->items()->create([

                    'budget_line' => $request->budget_line[$index] ?? null,

                    'description' => $description,

                    'qty' => $qty,

                    'unit_price' => $unitPrice,

                    'extended_price' => $qty * $unitPrice,

                ]);
            }
        });

        return redirect()
            ->route('verbal-quotes.index')
            ->with('success', 'Verbal Quote updated successfully.');
    }


    public function destroy(VerbalQuote $verbalQuote)
    {
        $verbalQuote->delete();

        return redirect()
            ->route('verbal-quotes.index')
            ->with('success', 'Verbal Quote deleted successfully.');
    }

    public function pdf(VerbalQuote $verbalQuote)
    {
        $verbalQuote->load([
            'requester',
            'preparer',
            'items',
        ]);

        $html = view('verbal-quotes.pdf', compact('verbalQuote'))->render();

        // Replace non-breaking spaces
        $html = str_replace("\xc2\xa0", ' ', $html);

        try {

            $mpdf = new Mpdf([
                'mode'              => 'utf-8',
                'format'            => 'A4',
                'margin_left'       => 8,
                'margin_right'      => 8,
                'margin_top'        => 8,
                'margin_bottom'     => 8,
                'margin_header'     => 5,
                'margin_footer'     => 5,
                'autoScriptToLang'  => true,
                'autoLangToFont'    => true,
                'tempDir'           => storage_path('app/mpdf'),
            ]);

            $mpdf->SetTitle('Verbal Quotation');

            $mpdf->SetAuthor(config('app.name'));

            $mpdf->SetDisplayMode('fullpage');

            // Watermark Logo
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
                    'Verbal_Quote_' . $verbalQuote->quote_number . '.pdf',
                    Destination::STRING_RETURN
                ),
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="Verbal_Quote_' . $verbalQuote->quote_number . '.pdf"',
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

        $html = view('verbal-quotes.template')->render();

        // Remove non-breaking spaces
        $html = str_replace("\xc2\xa0", ' ', $html);

        try {

            $mpdf = new Mpdf([
                'mode'             => 'utf-8',
                'format'           => 'A4',

                'margin_left'      => 8,
                'margin_right'     => 8,
                'margin_top'       => 8,
                'margin_bottom'    => 8,

                'margin_header'    => 5,
                'margin_footer'    => 5,

                'autoScriptToLang' => true,
                'autoLangToFont'   => true,

                'tempDir'          => storage_path('app/mpdf'),
            ]);

            $mpdf->SetTitle(
                'Verbal Quotation FM02-09 Template'
            );

            $mpdf->SetAuthor(
                config('app.name')
            );

            $mpdf->SetDisplayMode('fullpage');


            $logo = public_path('images/logo.png');

            if (file_exists($logo)) {

                $mpdf->SetWatermarkImage(
                    $logo,
                    0.06,
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
                    'Verbal_Quote_FM02-09_Template.pdf',
                    Destination::STRING_RETURN
                ),
                200,
                [
                    'Content-Type' => 'application/pdf',

                    'Content-Disposition' =>
                    'inline; filename="Verbal_Quote_FM02-09_Template.pdf"',
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
