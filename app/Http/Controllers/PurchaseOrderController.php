<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Mpdf\HTMLParserMode;


class PurchaseOrderController extends Controller
{


    public function index(Request $request)
    {
        $user = auth()->user();

        $query = PurchaseOrder::with('items');

        if ($user->role?->name !== 'Admin') {
            $query->where('ordered_by', $user->id);
        }

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('po_no', 'like', "%{$search}%")
                    ->orWhere('pr_no', 'like', "%{$search}%")
                    ->orWhere('supplier_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        $purchaseOrders = $query
            ->latest()
            ->paginate(10);

        return view(
            'purchase_orders.index',
            compact('purchaseOrders')
        );
    }


    public function create()
    {
        $nextNumber =
            PurchaseOrder::whereYear(
                'created_at',
                now()->year
            )->count() + 1;


        $poNo =
            'PO-' .
            now()->format('Y') .
            '-' .
            str_pad(
                $nextNumber,
                3,
                '0',
                STR_PAD_LEFT
            );


        return view(
            'purchase_orders.create',
            compact('poNo')
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([


            'po_no' => [
                'required',
                'string',
                'max:100',
                'unique:purchase_orders,po_no',
            ],

            'pr_no' => [
                'nullable',
                'string',
                'max:100',
            ],

            'po_date' => [
                'required',
                'date',
            ],


            'supplier_name' => [
                'required',
                'string',
                'max:255',
            ],

            'supplier_address' => [
                'nullable',
                'string',
            ],

            'supplier_phone' => [
                'nullable',
                'string',
                'max:100',
            ],


            'delivery_address' => [
                'nullable',
                'string',
            ],

            'delivery_date' => [
                'nullable',
                'date',
            ],


            'term_of_payment' => [
                'nullable',
                'string',
                'max:255',
            ],

            'mode_of_payment' => [
                'nullable',
                'string',
                'max:255',
            ],

            'term_of_delivery' => [
                'nullable',
                'string',
                'max:255',
            ],

            'currency' => [
                'required',
                'string',
                'max:10',
            ],


            'tax_percent' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_charges' => [
                'nullable',
                'numeric',
                'min:0',
            ],


            'ordered_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'ordered_date' => [
                'nullable',
                'date',
            ],

            'approved_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'approved_date' => [
                'nullable',
                'date',
            ],

            'vendor_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vendor_position' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vendor_date' => [
                'nullable',
                'date',
            ],


            'status' => [
                'required',
                'in:Draft,Pending,Approved,Rejected,Completed,Cancelled',
            ],

            'notes' => [
                'nullable',
                'string',
            ],


            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.description' => [
                'required',
                'string',
            ],

            'items.*.required_date' => [
                'nullable',
                'date',
            ],

            'items.*.unit' => [
                'nullable',
                'string',
                'max:50',
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

            $purchaseOrder = PurchaseOrder::create([

                'po_no' => $validated['po_no'],

                'pr_no' => $validated['pr_no'] ?? null,

                'po_date' => $validated['po_date'],


                'supplier_name' =>
                $validated['supplier_name'],

                'supplier_address' =>
                $validated['supplier_address'] ?? null,

                'supplier_phone' =>
                $validated['supplier_phone'] ?? null,


                'delivery_address' =>
                $validated['delivery_address'] ?? null,

                'delivery_date' =>
                $validated['delivery_date'] ?? null,


                'term_of_payment' =>
                $validated['term_of_payment'] ?? null,

                'mode_of_payment' =>
                $validated['mode_of_payment'] ?? null,

                'term_of_delivery' =>
                $validated['term_of_delivery'] ?? null,

                'currency' =>
                $validated['currency'],


                'tax_percent' =>
                $validated['tax_percent'] ?? 0,

                'other_charges' =>
                $validated['other_charges'] ?? 0,


                'ordered_by' =>
                $validated['ordered_by'] ?? null,

                'ordered_date' =>
                $validated['ordered_date'] ?? null,

                'approved_by' =>
                $validated['approved_by'] ?? null,

                'approved_date' =>
                $validated['approved_date'] ?? null,


                'vendor_name' =>
                $validated['vendor_name'] ?? null,

                'vendor_position' =>
                $validated['vendor_position'] ?? null,

                'vendor_date' =>
                $validated['vendor_date'] ?? null,


                'status' =>
                $validated['status'],

                'notes' =>
                $validated['notes'] ?? null,
            ]);


            foreach ($validated['items'] as $index => $item) {

                $quantity =
                    (float) $item['quantity'];

                $unitPrice =
                    (float) $item['unit_price'];


                $total =
                    $quantity * $unitPrice;


                $purchaseOrder->items()->create([

                    'sort_order' =>
                    $index + 1,

                    'description' =>
                    $item['description'],

                    'required_date' =>
                    $item['required_date'] ?? null,

                    'unit' =>
                    $item['unit'] ?? null,

                    'quantity' =>
                    $quantity,

                    'unit_price' =>
                    $unitPrice,

                    'total' =>
                    $total,
                ]);
            }
        });


        return redirect()
            ->route('purchase-orders.index')
            ->with(
                'success',
                'Purchase Order created successfully.'
            );
    }


    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load('items');


        return view(
            'purchase_orders.show',
            compact('purchaseOrder')
        );
    }


    public function edit(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load('items');


        return view(
            'purchase_orders.edit',
            compact('purchaseOrder')
        );
    }


    public function update(
        Request $request,
        PurchaseOrder $purchaseOrder
    ) {

        $validated = $request->validate([

            'po_no' => [
                'required',
                'string',
                'max:100',
                'unique:purchase_orders,po_no,' .
                    $purchaseOrder->id,
            ],

            'pr_no' => [
                'nullable',
                'string',
                'max:100',
            ],

            'po_date' => [
                'required',
                'date',
            ],

            'supplier_name' => [
                'required',
                'string',
                'max:255',
            ],

            'supplier_address' => [
                'nullable',
                'string',
            ],

            'supplier_phone' => [
                'nullable',
                'string',
                'max:100',
            ],

            'delivery_address' => [
                'nullable',
                'string',
            ],

            'delivery_date' => [
                'nullable',
                'date',
            ],

            'term_of_payment' => [
                'nullable',
                'string',
                'max:255',
            ],

            'mode_of_payment' => [
                'nullable',
                'string',
                'max:255',
            ],

            'term_of_delivery' => [
                'nullable',
                'string',
                'max:255',
            ],

            'currency' => [
                'required',
                'string',
                'max:10',
            ],

            'tax_percent' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'other_charges' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'ordered_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'ordered_date' => [
                'nullable',
                'date',
            ],

            'approved_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'approved_date' => [
                'nullable',
                'date',
            ],

            'vendor_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vendor_position' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vendor_date' => [
                'nullable',
                'date',
            ],

            'status' => [
                'required',
                'in:Draft,Pending,Approved,Rejected,Completed,Cancelled',
            ],

            'notes' => [
                'nullable',
                'string',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.description' => [
                'required',
                'string',
            ],

            'items.*.required_date' => [
                'nullable',
                'date',
            ],

            'items.*.unit' => [
                'nullable',
                'string',
                'max:50',
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
            $purchaseOrder
        ) {

            $purchaseOrder->update([

                'po_no' =>
                $validated['po_no'],

                'pr_no' =>
                $validated['pr_no'] ?? null,

                'po_date' =>
                $validated['po_date'],

                'supplier_name' =>
                $validated['supplier_name'],

                'supplier_address' =>
                $validated['supplier_address'] ?? null,

                'supplier_phone' =>
                $validated['supplier_phone'] ?? null,

                'delivery_address' =>
                $validated['delivery_address'] ?? null,

                'delivery_date' =>
                $validated['delivery_date'] ?? null,

                'term_of_payment' =>
                $validated['term_of_payment'] ?? null,

                'mode_of_payment' =>
                $validated['mode_of_payment'] ?? null,

                'term_of_delivery' =>
                $validated['term_of_delivery'] ?? null,

                'currency' =>
                $validated['currency'],

                'tax_percent' =>
                $validated['tax_percent'] ?? 0,

                'other_charges' =>
                $validated['other_charges'] ?? 0,

                'ordered_by' =>
                $validated['ordered_by'] ?? null,

                'ordered_date' =>
                $validated['ordered_date'] ?? null,

                'approved_by' =>
                $validated['approved_by'] ?? null,

                'approved_date' =>
                $validated['approved_date'] ?? null,

                'vendor_name' =>
                $validated['vendor_name'] ?? null,

                'vendor_position' =>
                $validated['vendor_position'] ?? null,

                'vendor_date' =>
                $validated['vendor_date'] ?? null,

                'status' =>
                $validated['status'],

                'notes' =>
                $validated['notes'] ?? null,
            ]);


            $purchaseOrder->items()->delete();


            foreach ($validated['items'] as $index => $item) {

                $quantity =
                    (float) $item['quantity'];

                $unitPrice =
                    (float) $item['unit_price'];


                $purchaseOrder->items()->create([

                    'sort_order' =>
                    $index + 1,

                    'description' =>
                    $item['description'],

                    'required_date' =>
                    $item['required_date'] ?? null,

                    'unit' =>
                    $item['unit'] ?? null,

                    'quantity' =>
                    $quantity,

                    'unit_price' =>
                    $unitPrice,

                    'total' =>
                    $quantity * $unitPrice,
                ]);
            }
        });


        return redirect()
            ->route(
                'purchase-orders.show',
                $purchaseOrder
            )
            ->with(
                'success',
                'Purchase Order updated successfully.'
            );
    }

    public function destroy(
        PurchaseOrder $purchaseOrder
    ) {

        $purchaseOrder->delete();


        return redirect()
            ->route('purchase-orders.index')
            ->with(
                'success',
                'Purchase Order deleted successfully.'
            );
    }


    public function pdf(PurchaseOrder $purchaseOrder)
    {
        $start = microtime(true);

        try {

            $purchaseOrder->load('items');

            Log::info('PDF 1 - Load', [
                'time' => microtime(true) - $start,
            ]);

            $html = view(
                'purchase_orders.pdf',
                compact('purchaseOrder')
            )->render();

            Log::info('PDF 2 - Blade', [
                'time' => microtime(true) - $start,
                'html_size' => strlen($html),
            ]);

            $html = str_replace(
                "\xc2\xa0",
                ' ',
                $html
            );

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
                'margin_top' => 5,
                'margin_bottom' => 6,

                'autoScriptToLang'  => true,
                'autoLangToFont'    => true,

                'tempDir' => $tempDir,
            ]);

            Log::info('PDF 3 - mPDF created', [
                'time' => microtime(true) - $start,
            ]);

            $mpdf->SetTitle(
                'Purchase Order - ' . $purchaseOrder->po_no
            );

            $logo = public_path('images/logo.png');

            if (file_exists($logo)) {
                $mpdf->SetWatermarkImage(
                    $logo,
                    0.05,
                    [150, 100],
                    [30, 80]
                );

                $mpdf->showWatermarkImage = true;
                $mpdf->watermarkImgBehind = true;
            }

            Log::info('PDF 4 - Before WriteHTML', [
                'time' => microtime(true) - $start,
            ]);

            $mpdf->WriteHTML($html);

            Log::info('PDF 5 - WriteHTML finished', [
                'time' => microtime(true) - $start,
            ]);

            $filename =
                'Purchase_Order_' .
                $purchaseOrder->po_no .
                '.pdf';

            $pdf = $mpdf->Output(
                $filename,
                Destination::STRING_RETURN
            );

            Log::info('PDF 6 - Output finished', [
                'time' => microtime(true) - $start,
                'pdf_size' => strlen($pdf),
            ]);

            return response($pdf, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' =>
                'inline; filename="' . $filename . '"',
            ]);
        } catch (\Throwable $e) {

            Log::error('Purchase Order PDF Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'message' => 'Unable to generate PDF.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
