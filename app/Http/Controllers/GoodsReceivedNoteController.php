<?php

namespace App\Http\Controllers;

use App\Models\GoodsReceivedNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class GoodsReceivedNoteController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();

        $query = GoodsReceivedNote::with([
            'items',
            'creator',
        ]);


        if ($user->role?->name !== 'Admin') {

            $query->where(
                'created_by',
                $user->id
            );
        }

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'grn_no',
                    'like',
                    "%{$search}%"
                )

                    ->orWhere(
                        'supplier_name',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'po_no',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'vendor_invoice_no',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'delivery_note_no',
                        'like',
                        "%{$search}%"
                    );
            });
        }

        $goodsReceivedNotes = $query
            ->latest()
            ->paginate(10);


        return view(
            'goods_received_notes.index',
            compact('goodsReceivedNotes')
        );
    }


    public function create()
    {
        $grnNo = $this->generateGrnNumber();

        return view(
            'goods_received_notes.create',
            compact('grnNo')
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([

            'grn_no' => [
                'required',
                'string',
                'max:255',
                'unique:goods_received_notes,grn_no',
            ],

            'grn_date' => [
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

            'supplier_tel' => [
                'nullable',
                'string',
                'max:255',
            ],


            'po_no' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vendor_invoice_no' => [
                'nullable',
                'string',
                'max:255',
            ],

            'delivery_note_no' => [
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
            ],

            'items.*.inspection_criteria' => [
                'nullable',
                'string',
            ],

            'items.*.ordered_quantity' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.received' => [
                'nullable',
                'boolean',
            ],

            'items.*.inspected' => [
                'nullable',
                'boolean',
            ],

            'items.*.result' => [
                'nullable',
                'in:accepted,rejected',
            ],

            'delivered_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'delivered_date' => [
                'nullable',
                'date',
            ],

            'delivered_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'received_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'received_date' => [
                'nullable',
                'date',
            ],

            'received_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'inspected_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'inspected_date' => [
                'nullable',
                'date',
            ],

            'inspected_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'comments' => [
                'nullable',
                'string',
            ],

        ]);

        DB::transaction(function () use ($validated) {

            $grn = GoodsReceivedNote::create([

                // GRN Information
                'grn_no' => $validated['grn_no'],

                'grn_date' => $validated['grn_date'],


                // Supplier Information
                'supplier_name' => $validated['supplier_name'],

                'supplier_address' =>
                $validated['supplier_address'] ?? null,

                'supplier_tel' =>
                $validated['supplier_tel'] ?? null,


                // Reference Information
                'po_no' =>
                $validated['po_no'] ?? null,

                'vendor_invoice_no' =>
                $validated['vendor_invoice_no'] ?? null,

                'delivery_note_no' =>
                $validated['delivery_note_no'] ?? null,


                // Delivery Information
                'delivered_by' =>
                $validated['delivered_by'] ?? null,

                'delivered_date' =>
                $validated['delivered_date'] ?? null,

                'delivered_time' =>
                $validated['delivered_time'] ?? null,


                // Receiving Information
                'received_by' =>
                $validated['received_by'] ?? null,

                'received_date' =>
                $validated['received_date'] ?? null,

                'received_time' =>
                $validated['received_time'] ?? null,


                // Inspection Information
                'inspected_by' =>
                $validated['inspected_by'] ?? null,

                'inspected_date' =>
                $validated['inspected_date'] ?? null,

                'inspected_time' =>
                $validated['inspected_time'] ?? null,


                // Comments
                'comments' =>
                $validated['comments'] ?? null,


                // Creator
                'created_by' =>
                auth()->id(),
            ]);

            foreach ($validated['items'] as $index => $item) {

                $result = $item['result'] ?? null;


                $accepted = $result === 'accepted';

                $rejected = $result === 'rejected';

                $grn->items()->create([

                    'sort_order' =>
                    $index,

                    'description' =>
                    $item['description'],

                    'inspection_criteria' =>
                    $item['inspection_criteria'] ?? null,

                    'ordered_quantity' =>
                    $item['ordered_quantity'],


                    // Checkbox values
                    'received' =>
                    isset($item['received']),

                    'inspected' =>
                    isset($item['inspected']),


                    // Radio button result
                    'accepted' =>
                    $accepted,

                    'rejected' =>
                    $rejected,
                ]);
            }
        });

        return redirect()
            ->route('goods-received-notes.index')
            ->with(
                'success',
                'Goods Received Note created successfully.'
            );
    }


    public function show(GoodsReceivedNote $goodsReceivedNote)
    {
        $user = auth()->user();

        if (
            $user->role?->name !== 'Admin'
            &&
            $goodsReceivedNote->created_by !== $user->id
        ) {

            abort(403);
        }


        $goodsReceivedNote->load([
            'items',
            'creator',
        ]);


        return view(
            'goods_received_notes.show',
            compact('goodsReceivedNote')
        );
    }


    public function edit(GoodsReceivedNote $goodsReceivedNote)
    {
        $user = auth()->user();


        if (
            $user->role?->name !== 'Admin'
            &&
            $goodsReceivedNote->created_by !== $user->id
        ) {

            abort(403);
        }


        $goodsReceivedNote->load('items');


        return view(
            'goods_received_notes.edit',
            compact('goodsReceivedNote')
        );
    }


    public function update(Request $request, GoodsReceivedNote $goodsReceivedNote)
    {

        $user = auth()->user();

        if (
            $user->role?->name !== 'Admin'
            &&
            $goodsReceivedNote->created_by !== $user->id
        ) {
            abort(403);
        }

        $validated = $request->validate([

            'grn_no' => [
                'required',
                'string',
                'max:255',
                'unique:goods_received_notes,grn_no,'
                    . $goodsReceivedNote->id,
            ],

            'grn_date' => [
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

            'supplier_tel' => [
                'nullable',
                'string',
                'max:255',
            ],

            'po_no' => [
                'nullable',
                'string',
                'max:255',
            ],

            'vendor_invoice_no' => [
                'nullable',
                'string',
                'max:255',
            ],

            'delivery_note_no' => [
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
            ],

            'items.*.inspection_criteria' => [
                'nullable',
                'string',
            ],

            'items.*.ordered_quantity' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.received' => [
                'nullable',
            ],

            'items.*.inspected' => [
                'nullable',
            ],

            'items.*.result' => [
                'nullable',
                'in:accepted,rejected',
            ],

            'delivered_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'delivered_date' => [
                'nullable',
                'date',
            ],

            'delivered_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'received_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'received_date' => [
                'nullable',
                'date',
            ],

            'received_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'inspected_by' => [
                'nullable',
                'string',
                'max:255',
            ],

            'inspected_date' => [
                'nullable',
                'date',
            ],

            'inspected_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'comments' => [
                'nullable',
                'string',
            ],

        ]);


        DB::transaction(function () use (
            $validated,
            $goodsReceivedNote
        ) {

            $goodsReceivedNote->update([

                // GRN Information
                'grn_no' =>
                $validated['grn_no'],

                'grn_date' =>
                $validated['grn_date'],


                // Supplier Information
                'supplier_name' =>
                $validated['supplier_name'],

                'supplier_address' =>
                $validated['supplier_address'] ?? null,

                'supplier_tel' =>
                $validated['supplier_tel'] ?? null,


                // Reference Information
                'po_no' =>
                $validated['po_no'] ?? null,

                'vendor_invoice_no' =>
                $validated['vendor_invoice_no'] ?? null,

                'delivery_note_no' =>
                $validated['delivery_note_no'] ?? null,


                // Delivery Information
                'delivered_by' =>
                $validated['delivered_by'] ?? null,

                'delivered_date' =>
                $validated['delivered_date'] ?? null,

                'delivered_time' =>
                $validated['delivered_time'] ?? null,


                // Receiving Information
                'received_by' =>
                $validated['received_by'] ?? null,

                'received_date' =>
                $validated['received_date'] ?? null,

                'received_time' =>
                $validated['received_time'] ?? null,


                // Inspection Information
                'inspected_by' =>
                $validated['inspected_by'] ?? null,

                'inspected_date' =>
                $validated['inspected_date'] ?? null,

                'inspected_time' =>
                $validated['inspected_time'] ?? null,


                // Comments
                'comments' =>
                $validated['comments'] ?? null,
            ]);


            $goodsReceivedNote
                ->items()
                ->delete();

            foreach ($validated['items'] as $index => $item) {

                $result = $item['result'] ?? null;

                $accepted =
                    $result === 'accepted';

                $rejected =
                    $result === 'rejected';


                $goodsReceivedNote->items()->create([

                    'sort_order' =>
                    $index,

                    'description' =>
                    $item['description'],

                    'inspection_criteria' =>
                    $item['inspection_criteria'] ?? null,

                    'ordered_quantity' =>
                    $item['ordered_quantity'],


                    // Checkboxes
                    'received' =>
                    isset($item['received']),

                    'inspected' =>
                    isset($item['inspected']),


                    // Radio button result
                    'accepted' =>
                    $accepted,

                    'rejected' =>
                    $rejected,
                ]);
            }
        });

        return redirect()
            ->route('goods-received-notes.index')
            ->with(
                'success',
                'Goods Received Note updated successfully.'
            );
    }


    public function destroy(
        GoodsReceivedNote $goodsReceivedNote
    ) {

        $user = auth()->user();


        if (
            $user->role?->name !== 'Admin'
            &&
            $goodsReceivedNote->created_by !== $user->id
        ) {

            abort(403);
        }


        $goodsReceivedNote->delete();


        return redirect()
            ->route('goods-received-notes.index')
            ->with(
                'success',
                'Goods Received Note deleted successfully.'
            );
    }


    private function generateGrnNumber(): string
    {
        $year = now()->format('Y');

        $last = GoodsReceivedNote::whereYear(
            'created_at',
            $year
        )
            ->orderByDesc('id')
            ->first();


        $number = $last
            ? ((int) substr($last->grn_no, -3)) + 1
            : 1;


        return sprintf(
            'GRN-%s-%03d',
            $year,
            $number
        );
    }


    public function pdf(GoodsReceivedNote $goodsReceivedNote)
    {
        $start = microtime(true);

        try {

            $user = auth()->user();

            if (
                $user->role?->name !== 'Admin'
                &&
                $goodsReceivedNote->created_by !== $user->id
            ) {
                abort(403);
            }


            $goodsReceivedNote->load([
                'items',
                'creator',
            ]);

            Log::info('GRN PDF 1 - Load', [
                'time' => microtime(true) - $start,
            ]);


            $html = view(
                'goods_received_notes.pdf',
                compact('goodsReceivedNote')
            )->render();


            Log::info('GRN PDF 2 - Blade', [
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

                mkdir(
                    $tempDir,
                    0755,
                    true
                );
            }


            $mpdf = new Mpdf([

                'mode' => 'utf-8',

                'format' => 'A4',

                'orientation' => 'P',

                'margin_left' => 6,

                'margin_right' => 6,

                'margin_top' => 5,

                'margin_bottom' => 6,

                'margin_header' => 0,

                'margin_footer' => 0,

                'autoScriptToLang' => true,

                'autoLangToFont' => true,

                'tempDir' => $tempDir,

            ]);


            Log::info('GRN PDF 3 - mPDF created', [
                'time' => microtime(true) - $start,
            ]);


            $mpdf->SetTitle(
                'Goods Received Note - '
                    . $goodsReceivedNote->grn_no
            );

            $mpdf->SetAuthor(
                'NGO Forum on Cambodia'
            );


            $logo = public_path(
                'images/logo.png'
            );


            if (file_exists($logo)) {

                $mpdf->SetWatermarkImage(

                    $logo,

                    // Logo opacity
                    0.06,

                    // Logo size
                    [140, 100],

                    // Position
                    [35, 80]
                );


                // Show logo
                $mpdf->showWatermarkImage = true;


                // Put logo behind document
                $mpdf->watermarkImgBehind = true;
            }


            Log::info('GRN PDF 4 - Before WriteHTML', [
                'time' => microtime(true) - $start,
            ]);


            $mpdf->WriteHTML($html);


            Log::info('GRN PDF 5 - WriteHTML finished', [
                'time' => microtime(true) - $start,
            ]);


            $filename =
                'GRN_' .
                $goodsReceivedNote->grn_no .
                '.pdf';


            $pdf = $mpdf->Output(
                $filename,
                Destination::STRING_RETURN
            );


            Log::info('GRN PDF 6 - Output finished', [
                'time' => microtime(true) - $start,
                'pdf_size' => strlen($pdf),
            ]);

            return response(
                $pdf,
                200,
                [
                    'Content-Type' =>
                    'application/pdf',

                    'Content-Disposition' =>
                    'inline; filename="' .
                        $filename .
                        '"',
                ]
            );
        } catch (\Throwable $e) {

            Log::error(
                'Goods Received Note PDF Error',
                [
                    'message' =>
                    $e->getMessage(),

                    'line' =>
                    $e->getLine(),

                    'file' =>
                    $e->getFile(),

                    'grn_id' =>
                    $goodsReceivedNote->id ?? null,
                ]
            );


            return response()->json([
                'message' =>
                'Unable to generate GRN PDF.',

                'error' =>
                $e->getMessage(),

            ], 500);
        }
    }
}
