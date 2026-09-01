<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        $invoices = Invoice::query()
            ->when($request->invoice_no, function ($query, $value) {
                $query->where(
                    'invoice_no',
                    'like',
                    "%{$value}%"
                );
            })

            ->when($request->customer, function ($query, $value) {
                $query->where(
                    'customer',
                    'like',
                    "%{$value}%"
                );
            })

            ->when($request->invoice_date, function ($query, $value) {
                $query->whereDate(
                    'invoice_date',
                    $value
                );
            })

            ->latest('id')
            ->paginate(10);

        return view(
            'invoices.index',
            compact('invoices')
        );
    }


    public function create()
    {
        return view('invoices.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'invoice_no' => [
                'required',
                'string',
                'max:100',
                'unique:invoices,invoice_no',
            ],

            'invoice_date' => [
                'required',
                'date',
            ],

            'customer' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:100',
            ],

            'amount_in_words' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'company' => [
                'nullable',
                'string',
                'max:255',
            ],

            'issued_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.description' => [
                'required',
                'string',
                'max:2000',
            ],

            'items.*.quantity' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);


        DB::transaction(function () use ($validated) {

            $grandTotal = 0;


            // Calculate total first
            foreach ($validated['items'] as $item) {

                $quantity = (float) $item['quantity'];
                $unitPrice = (float) $item['unit_price'];

                $grandTotal += $quantity * $unitPrice;
            }


            // Create invoice
            $invoice = Invoice::create([

                'created_by' => auth()->id(),

                'invoice_no' => $validated['invoice_no'],

                'invoice_date' => $validated['invoice_date'],

                'customer' => $validated['customer'] ?? null,

                'address' => $validated['address'] ?? null,

                'telephone' => $validated['telephone'] ?? null,

                'grand_total' => $grandTotal,

                'amount_in_words' =>
                $validated['amount_in_words'] ?? null,

                'company' =>
                $validated['company'] ?? null,

                'issued_by' =>
                $validated['issued_by'] ?? null,
            ]);


            // Create items
            foreach ($validated['items'] as $index => $item) {

                $quantity = (float) $item['quantity'];

                $unitPrice = (float) $item['unit_price'];

                $amount = $quantity * $unitPrice;


                $invoice->items()->create([

                    'sort_order' => $index + 1,

                    'description' => $item['description'],

                    'quantity' => $quantity,

                    'unit_price' => $unitPrice,

                    'amount' => $amount,
                ]);
            }
        });


        return redirect()
            ->route('invoices.index')
            ->with(
                'success',
                'Invoice created successfully.'
            );
    }



    public function show(Invoice $invoice)
    {
        $invoice->load('items');

        return view(
            'invoices.show',
            compact('invoice')
        );
    }



    public function edit(Invoice $invoice)
    {
        $invoice->load('items');

        return view(
            'invoices.edit',
            compact('invoice')
        );
    }



    public function update(
        Request $request,
        Invoice $invoice
    ) {

        $validated = $request->validate([

            'invoice_no' => [
                'required',
                'string',
                'max:100',
                'unique:invoices,invoice_no,' . $invoice->id,
            ],

            'invoice_date' => [
                'required',
                'date',
            ],

            'customer' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:100',
            ],

            'amount_in_words' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'company' => [
                'nullable',
                'string',
                'max:255',
            ],

            'issued_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.description' => [
                'required',
                'string',
                'max:2000',
            ],

            'items.*.quantity' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);


        DB::transaction(function () use (
            $validated,
            $invoice
        ) {

            $grandTotal = 0;


            foreach ($validated['items'] as $item) {

                $quantity = (float) $item['quantity'];

                $unitPrice = (float) $item['unit_price'];

                $grandTotal += $quantity * $unitPrice;
            }


            $invoice->update([

                'invoice_no' =>
                $validated['invoice_no'],

                'invoice_date' =>
                $validated['invoice_date'],

                'customer' =>
                $validated['customer'] ?? null,

                'address' =>
                $validated['address'] ?? null,

                'telephone' =>
                $validated['telephone'] ?? null,

                'grand_total' =>
                $grandTotal,

                'amount_in_words' =>
                $validated['amount_in_words'] ?? null,

                'company' =>
                $validated['company'] ?? null,

                'issued_by' =>
                $validated['issued_by'] ?? null,
            ]);


            // Remove old items
            $invoice->items()->delete();


            // Insert updated items
            foreach (
                $validated['items']
                as $index => $item
            ) {

                $quantity =
                    (float) $item['quantity'];

                $unitPrice =
                    (float) $item['unit_price'];

                $amount =
                    $quantity * $unitPrice;


                $invoice->items()->create([

                    'sort_order' =>
                    $index + 1,

                    'description' =>
                    $item['description'],

                    'quantity' =>
                    $quantity,

                    'unit_price' =>
                    $unitPrice,

                    'amount' =>
                    $amount,
                ]);
            }
        });


        return redirect()
            ->route(
                'invoices.index'
            )
            ->with(
                'success',
                'Invoice updated successfully.'
            );
    }


    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->with(
                'success',
                'Invoice deleted successfully.'
            );
    }


    public function pdf(Invoice $invoice)
    {
        try {
            $invoice->load('items');

            $html = view('invoices.pdf', compact('invoice'))->render();

            // Clean non-breaking spaces
            $html = str_replace("\xc2\xa0", ' ', $html);

            $tempDir = storage_path('app/mpdf');
            if (!is_dir($tempDir)) {
                mkdir($tempDir, 0755, true);
            }

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',
                'margin_left' => 6,
                'margin_right' => 6,
                'margin_top' => 6,
                'margin_bottom' => 6,
                'autoScriptToLang' => true,
                'autoLangToFont' => true,
                'tempDir' => $tempDir,
            ]);

            // Watermark Logo setup
            $logo = public_path('images/logo.png');
            if (file_exists($logo)) {
                $mpdf->SetWatermarkImage($logo, 0.05, [120, 80], [45, 100]);
                $mpdf->showWatermarkImage = true;
                $mpdf->watermarkImgBehind = true;
            }

            $mpdf->WriteHTML($html);

            $filename = 'Invoice-' . $invoice->invoice_no . '.pdf';

            return response($mpdf->Output($filename, Destination::STRING_RETURN), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
            ]);
        } catch (\Throwable $e) {
            Log::error('Invoice PDF Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'message' => 'Unable to generate Invoice PDF.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function template()
    {
        try {
            $tempDir = storage_path('app/mpdf');

            if (!is_dir($tempDir)) {
                mkdir($tempDir, 0755, true);
            }

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',

                'margin_left' => 6,
                'margin_right' => 6,
                'margin_top' => 6,
                'margin_bottom' => 6,

                'autoScriptToLang' => true,
                'autoLangToFont' => true,

                'tempDir' => $tempDir,
            ]);


            $logo = public_path('images/logo.png');

            if (file_exists($logo)) {
                $mpdf->SetWatermarkImage(
                    $logo,
                    0.06,
                    [120, 80],
                    [45, 100]
                );

                $mpdf->showWatermarkImage = true;
                $mpdf->watermarkImgBehind = true;
            }

            $html = view('invoices.template')->render();

            $html = str_replace(
                "\xc2\xa0",
                ' ',
                $html
            );

            $mpdf->SetTitle('Invoice Template');

            $mpdf->SetAuthor(
                'NGO Forum on Cambodia'
            );

            $mpdf->WriteHTML($html);

            $filename = 'Invoice-Template.pdf';

            return response(
                $mpdf->Output(
                    $filename,
                    Destination::STRING_RETURN
                ),
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' =>
                    'inline; filename="' .
                        $filename .
                        '"',
                ]
            );
        } catch (\Throwable $e) {

            Log::error('Invoice Template PDF Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'message' =>
                'Unable to generate Invoice template.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
