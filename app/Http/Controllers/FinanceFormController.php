<?php

namespace App\Http\Controllers;

use App\Models\FinanceForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\File;
use Mpdf\Mpdf;
use setasign\Fpdi\Tcpdf\Fpdi;
use Barryvdh\DomPDF\Facade\Pdf;



class FinanceFormController extends Controller
{

    public function index(Request $request)
    {
        $financeForms = FinanceForm::with('creator')
            ->when(
                $request->filled('voucher_no'),
                function ($query) use ($request) {
                    $query->where(
                        'voucher_no',
                        'like',
                        '%' . $request->voucher_no . '%'
                    );
                }
            )
            ->when(
                $request->filled('transaction_type'),
                function ($query) use ($request) {
                    $query->where(
                        'transaction_type',
                        $request->transaction_type
                    );
                }
            )
            ->when(
                $request->filled('status'),
                function ($query) use ($request) {
                    $query->where(
                        'status',
                        $request->status
                    );
                }
            )
            ->latest()
            ->paginate(10);

        return view(
            'finance-forms.index',
            compact('financeForms')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | JOURNAL ENTRY
    |--------------------------------------------------------------------------
    */

    public function createJournalEntry()
    {
        return view(
            'finance-forms.journal-entry.create',
            [
                'title' => 'Journal Entry',

                'transactionType' =>
                'journal_entry',

                'lineTypes' => [
                    'expense' => 'Expense',
                    'income'  => 'Income',
                    'bank'    => 'Bank',
                    'tax'     => 'Tax',
                    'other'   => 'Other',
                ],

                'initialRows' => [
                    [
                        'line_type'   => 'expense',
                        'description' => '',
                    ],
                    [
                        'line_type'   => 'expense',
                        'description' => '',
                    ],
                    [
                        'line_type'   => 'expense',
                        'description' => '',
                    ],
                    [
                        'line_type'   => 'income',
                        'description' => '',
                    ],
                ],

                'calculationType' =>
                'journal',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | INCOME
    |--------------------------------------------------------------------------
    */

    public function createIncome()
    {
        return view(
            'finance-forms.income.create',
            [
                'title' => 'Income',

                'transactionType' =>
                'income',

                'lineTypes' => [
                    'income'  => 'Income',
                    'bank'    => 'Bank',
                    'expense' => 'Expense',
                    'tax'     => 'Tax',
                    'other'   => 'Other',
                ],

                'initialRows' => [
                    [
                        'line_type'   => 'income',
                        'description' =>
                        'Income',
                    ],
                    [
                        'line_type'   => 'income',
                        'description' =>
                        'Income adjustment',
                    ],
                    [
                        'line_type'   => 'bank',
                        'description' =>
                        'Bank service charge',
                    ],
                    [
                        'line_type'   => 'bank',
                        'description' =>
                        'Bank account',
                    ],
                ],

                'calculationType' =>
                'income',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DIRECT PAY
    |--------------------------------------------------------------------------
    */

    public function createDirectPay()
    {
        return view(
            'finance-forms.direct-pay.create',
            [
                'title' => 'Direct Pay',

                'transactionType' =>
                'direct_payment',

                'lineTypes' => [
                    'expense' => 'Expense',
                    'payable' => 'Payable / Cash Payment',
                    'tax'     => 'Withholding Tax',
                    'bank'    => 'Bank / Cash',
                    'other'   => 'Other',
                ],

                'initialRows' => [
                    [
                        'line_type'   => 'expense',
                        'description' =>
                        'Gross payment',
                    ],
                    [
                        'line_type'   => 'payable',
                        'description' =>
                        'Cash / Bank payment',
                    ],
                    [
                        'line_type'   => 'tax',
                        'description' =>
                        'Withholding Tax',
                    ],
                    [
                        'line_type'   => 'tax',
                        'description' =>
                        'Withholding Tax',
                    ],
                    [
                        'line_type'   => 'tax',
                        'description' =>
                        'Withholding Tax',
                    ],
                ],

                'calculationType' =>
                'direct_payment',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REIMBURSEMENT
    |--------------------------------------------------------------------------
    */

    public function createReimbursement()
    {
        return view(
            'finance-forms.reimbursement.create',
            [
                'title' => 'Reimbursement',

                'transactionType' =>
                'reimbursement',

                'lineTypes' => [
                    'expense' => 'Expense',
                    'payable' => 'Payable / Reimbursement',
                    'bank'    => 'Bank / Cash',
                    'tax'     => 'Tax',
                    'other'   => 'Other',
                ],

                'initialRows' => [
                    [
                        'line_type'   => 'expense',
                        'description' =>
                        'Reimbursement expense',
                    ],
                    [
                        'line_type'   => 'expense',
                        'description' =>
                        'Reimbursement expense',
                    ],
                    [
                        'line_type'   => 'payable',
                        'description' =>
                        'Reimbursement payment',
                    ],
                ],

                'calculationType' =>
                'reimbursement',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DISBURSEMENT
    |--------------------------------------------------------------------------
    */

    public function createDisbursement()
    {
        return view(
            'finance-forms.disbursement.create',
            [
                'title' => 'Disbursement',

                'transactionType' =>
                'disbursement',

                'lineTypes' => [
                    'advance'    => 'Cash Advance',
                    'settlement' => 'Settlement',
                    'expense'    => 'Expense',
                    'bank'       => 'Bank / Cash',
                    'other'      => 'Other',
                ],

                'initialRows' => [
                    [
                        'line_type'   => 'advance',
                        'description' =>
                        'Cash advance',
                    ],
                    [
                        'line_type'   => 'settlement',
                        'description' =>
                        'Settle advance',
                    ],
                    [
                        'line_type'   => 'expense',
                        'description' =>
                        'Expense',
                    ],
                    [
                        'line_type'   => 'settlement',
                        'description' =>
                        'Settle expense',
                    ],
                ],

                'calculationType' =>
                'disbursement',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REFUND
    |
    | Excel Refund = Cash Advance Settlement
    |--------------------------------------------------------------------------
    */

    public function createCashAdvanceSettlement()
    {
        return view(
            'finance-forms.cash-advance-settlement.create',
            [
                'title' =>
                'Cash Advance Settlement',

                'transactionType' =>
                'cash_advance_settlement',

                'lineTypes' => [
                    'advance'    => 'Cash Advance',
                    'settlement' => 'Settlement',
                    'expense'    => 'Expense',
                    'bank'       => 'Bank / Cash',
                    'other'      => 'Other',
                ],

                'initialRows' => [
                    [
                        'line_type'   => 'advance',
                        'description' =>
                        'Cash advance',
                    ],
                    [
                        'line_type'   => 'settlement',
                        'description' =>
                        'Settlement',
                    ],
                    [
                        'line_type'   => 'settlement',
                        'description' =>
                        'Settlement',
                    ],
                    [
                        'line_type'   => 'expense',
                        'description' =>
                        'Expense',
                    ],
                    [
                        'line_type'   => 'settlement',
                        'description' =>
                        'Expense settlement',
                    ],
                ],

                'calculationType' =>
                'cash_advance_settlement',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'voucher_no' => [
                'nullable',
                'string',
                'max:255',
                'unique:finance_forms,voucher_no',
            ],

            'voucher_date' => [
                'required',
                'date',
            ],

            'transaction_type' => [
                'required',
                Rule::in([
                    'journal_entry',
                    'income',
                    'direct_payment',
                    'reimbursement',
                    'disbursement',
                    'cash_advance_settlement',
                ]),
            ],

            'received_from' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
             * This is displayed on screen but the
             * server recalculates it.
             */
            'amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'amount_in_words' => [
                'nullable',
                'string',
                'max:255',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.date' => [
                'required',
                'date',
            ],

            'items.*.line_type' => [
                'required',
                Rule::in([
                    'advance',
                    'expense',
                    'settlement',
                    'income',
                    'tax',
                    'payable',
                    'bank',
                    'other',
                ]),
            ],

            'items.*.description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'items.*.account_code' => [
                'nullable',
                'string',
                'max:255',
            ],

            'items.*.donor' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
             * Amount may be positive or negative.
             *
             * Positive:
             *       Debit
             *
             * Negative:
             *       Credit
             */
            'items.*.amount' => [
                'required',
                'numeric',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Remove completely empty rows
        |--------------------------------------------------------------------------
        */

        $items = collect($validated['items'])
            ->filter(function ($item) {

                return
                    trim(
                        (string) (
                            $item['description'] ?? ''
                        )
                    ) !== ''
                    ||
                    trim(
                        (string) (
                            $item['account_code'] ?? ''
                        )
                    ) !== ''
                    ||
                    trim(
                        (string) (
                            $item['donor'] ?? ''
                        )
                    ) !== ''
                    ||
                    (float) (
                        $item['amount'] ?? 0
                    ) != 0;
            })
            ->values()
            ->map(function ($item) {

                $amount =
                    round(
                        (float) (
                            $item['amount'] ?? 0
                        ),
                        2
                    );


                /*
                |--------------------------------------------------------------------------
                | Excel logic:
                |
                | Positive Amount = Debit
                | Negative Amount = Credit
                |--------------------------------------------------------------------------
                */

                $debit =
                    $amount > 0
                    ? $amount
                    : 0;


                $credit =
                    $amount < 0
                    ? abs($amount)
                    : 0;


                return [

                    'date' =>
                    $item['date'],

                    'line_type' =>
                    $item['line_type'],

                    'description' =>
                    $item['description'] ?? null,

                    'account_code' =>
                    $item['account_code'] ?? null,

                    'donor' =>
                    $item['donor'] ?? null,

                    'amount' =>
                    $amount,

                    'debit' =>
                    $debit,

                    'credit' =>
                    $credit,
                ];
            })
            ->values()
            ->toArray();


        if (count($items) === 0) {

            return back()
                ->withInput()
                ->withErrors([
                    'items' =>
                    'Please enter at least one accounting entry.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Calculate the voucher amount
        |--------------------------------------------------------------------------
        */

        $formAmount = $this->calculateFormAmount(
            $validated['transaction_type'],
            $items
        );


        /*
        |--------------------------------------------------------------------------
        | Store everything atomically
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $validated,
            $items,
            $formAmount
        ) {

            $financeForm =
                FinanceForm::create([

                    'voucher_no' =>
                    $validated['voucher_no']
                        ?? null,

                    'voucher_date' =>
                    $validated['voucher_date'],

                    'transaction_type' =>
                    $validated['transaction_type'],

                    'received_from' =>
                    $validated['received_from']
                        ?? null,

                    'amount' =>
                    $formAmount,

                    'amount_in_words' =>
                    $validated['amount_in_words']
                        ?? null,

                    'status' =>
                    'draft',

                    'created_by' =>
                    Auth::id(),
                ]);


            foreach (
                $items as $index => $item
            ) {

                $financeForm->items()->create([

                    'sort_order' =>
                    $index + 1,

                    'date' =>
                    $item['date'],

                    'line_type' =>
                    $item['line_type'],

                    'description' =>
                    $item['description'],

                    'account_code' =>
                    $item['account_code'],

                    'donor' =>
                    $item['donor'],

                    'amount' =>
                    $item['amount'],

                    'debit' =>
                    $item['debit'],

                    'credit' =>
                    $item['credit'],
                ]);
            }
        });


        return redirect()
            ->route('finance-forms.index')
            ->with(
                'success',
                'Finance form created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | CALCULATE FORM AMOUNT
    |--------------------------------------------------------------------------
    */

    private function calculateFormAmount(
        string $transactionType,
        array $items
    ): float {

        /*
        |--------------------------------------------------------------------------
        | JOURNAL ENTRY
        |--------------------------------------------------------------------------
        | Journal Entry does NOT have a transaction amount.
        | Only Debit and Credit totals are used.
        |--------------------------------------------------------------------------
        */

        if (
            $transactionType === 'journal_entry'
        ) {
            return 0;
        }


        /*
        |--------------------------------------------------------------------------
        | INCOME
        |
        | Income received
        | minus bank/expense/tax charges
        |
        | Example:
        |
        | 1000 income
        | -8 bank charge
        | = 992
        |--------------------------------------------------------------------------
        */

        if (
            $transactionType ===
            'income'
        ) {

            $income =
                collect($items)
                ->filter(function ($item) {

                    return
                        $item['line_type']
                        === 'income'
                        &&
                        (float) $item['amount'] > 0;
                })
                ->sum(function ($item) {

                    return
                        (float) $item['amount'];
                });


            $charges =
                collect($items)
                ->filter(function ($item) {

                    return
                        in_array(
                            $item['line_type'],
                            [
                                'expense',
                                'tax',
                                'bank',
                            ],
                            true
                        )
                        &&
                        (float) $item['amount'] > 0;
                })
                ->sum(function ($item) {

                    return
                        (float) $item['amount'];
                });


            return round(
                max(
                    0,
                    $income - $charges
                ),
                2
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DIRECT PAYMENT
        |
        | Prefer the negative Payable / Bank line.
        |
        | Example:
        |
        | Gross expense = 1200
        | Cash payment  = -1020
        | Tax           = -180
        |
        | Voucher amount = 1020
        |--------------------------------------------------------------------------
        */

        if (
            $transactionType ===
            'direct_payment'
        ) {

            $paymentLine =
                collect($items)
                ->first(function ($item) {

                    return
                        in_array(
                            $item['line_type'],
                            [
                                'payable',
                                'bank',
                            ],
                            true
                        )
                        &&
                        (float) $item['amount'] < 0;
                });


            if ($paymentLine) {

                return round(
                    abs(
                        (float)
                        $paymentLine['amount']
                    ),
                    2
                );
            }


            $expense =
                collect($items)
                ->filter(function ($item) {

                    return
                        $item['line_type']
                        === 'expense'
                        &&
                        (float) $item['amount'] > 0;
                })
                ->sum(function ($item) {

                    return
                        (float) $item['amount'];
                });


            return round(
                $expense,
                2
            );
        }


        /*
        |--------------------------------------------------------------------------
        | REIMBURSEMENT
        |
        | Total positive expense lines
        |--------------------------------------------------------------------------
        */

        if (
            $transactionType ===
            'reimbursement'
        ) {

            return round(
                collect($items)
                    ->filter(function ($item) {

                        return
                            $item['line_type']
                            === 'expense'
                            &&
                            (float) $item['amount'] > 0;
                    })
                    ->sum(function ($item) {

                        return
                            (float) $item['amount'];
                    }),
                2
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DISBURSEMENT
        |
        | Actual expense total
        |--------------------------------------------------------------------------
        */

        if ($transactionType === 'disbursement') {

            $advance = collect($items)
                ->filter(function ($item) {
                    return in_array(
                        $item['line_type'] ?? '',
                        ['advance', 'cash_advance'],
                        true
                    )
                        && (float) ($item['amount'] ?? 0) > 0;
                })
                ->sum(function ($item) {
                    return (float) ($item['amount'] ?? 0);
                });

            $expense = collect($items)
                ->filter(function ($item) {
                    return ($item['line_type'] ?? '') === 'expense'
                        && (float) ($item['amount'] ?? 0) > 0;
                })
                ->sum(function ($item) {
                    return (float) ($item['amount'] ?? 0);
                });

            return round(
                max($expense - $advance, 0),
                2
            );
        }


        /*
        |--------------------------------------------------------------------------
        | REFUND / CASH ADVANCE SETTLEMENT
        |
        | Actual expense total
        |--------------------------------------------------------------------------
        */

        if (
            $transactionType ===
            'cash_advance_settlement'
        ) {

            return round(
                collect($items)
                    ->filter(function ($item) {

                        return
                            $item['line_type']
                            === 'expense'
                            &&
                            (float) $item['amount'] > 0;
                    })
                    ->sum(function ($item) {

                        return
                            (float) $item['amount'];
                    }),
                2
            );
        }


        return round(
            collect($items)
                ->sum(function ($item) {

                    return
                        max(
                            0,
                            (float)
                            $item['amount']
                        );
                }),
            2
        );
    }

    public function destroy(FinanceForm $financeForm)
    {
        DB::transaction(function () use ($financeForm) {

            /*
        |--------------------------------------------------------------------------
        | Delete accounting items first
        |--------------------------------------------------------------------------
        */

            $financeForm->items()->delete();


            /*
        |--------------------------------------------------------------------------
        | Delete finance form
        |--------------------------------------------------------------------------
        */

            $financeForm->delete();
        });


        return redirect()
            ->route('finance-forms.index')
            ->with(
                'success',
                'Finance form deleted successfully.'
            );
    }

    /*
|--------------------------------------------------------------------------
| SHOW
|--------------------------------------------------------------------------
*/

    public function show(FinanceForm $financeForm)
    {
        $financeForm->load([
            'items',
            'creator',
        ]);

        return view(
            'finance-forms.show',
            compact('financeForm')
        );
    }


    /*
|--------------------------------------------------------------------------
| EDIT
|--------------------------------------------------------------------------
*/

    public function edit(FinanceForm $financeForm)
    {
        $financeForm->load('items');


        /*
    |--------------------------------------------------------------------------
    | Configuration for each finance sheet
    |--------------------------------------------------------------------------
    */

        $config = $this->getFormConfiguration(
            $financeForm->transaction_type
        );


        /*
    |--------------------------------------------------------------------------
    | Existing accounting rows
    |--------------------------------------------------------------------------
    */

        $initialRows = $financeForm->items
            ->map(function ($item) {

                return [

                    'line_type' =>
                    $item->line_type,

                    'description' =>
                    $item->description ?? '',

                    'date' =>
                    $item->date
                        ? $item->date->format('Y-m-d')
                        : now()->format('Y-m-d'),

                    'account_code' =>
                    $item->account_code ?? '',

                    'donor' =>
                    $item->donor ?? '',

                    'amount' =>
                    $item->amount !== null
                        ? (string) $item->amount
                        : '',
                ];
            })
            ->values()
            ->toArray();


        /*
    |--------------------------------------------------------------------------
    | If there are no items
    |--------------------------------------------------------------------------
    */

        if (empty($initialRows)) {

            $initialRows = [
                [
                    'line_type'   =>
                    array_key_first($config['lineTypes']),

                    'description' => '',

                    'date' =>
                    now()->format('Y-m-d'),

                    'account_code' => '',

                    'donor' => '',

                    'amount' => '',
                ],
            ];
        }


        return view(
            'finance-forms.edit',
            [

                'financeForm' =>
                $financeForm,

                'title' =>
                'Edit ' . $config['title'],

                'transactionType' =>
                $financeForm->transaction_type,

                'lineTypes' =>
                $config['lineTypes'],

                'initialRows' =>
                $initialRows,

                'calculationType' =>
                $config['calculationType'],
            ]
        );
    }


    /*
|--------------------------------------------------------------------------
| UPDATE
|--------------------------------------------------------------------------
*/

    public function update(
        Request $request,
        FinanceForm $financeForm
    ) {

        $validated = $request->validate([

            /*
        |--------------------------------------------------------------------------
        | Header
        |--------------------------------------------------------------------------
        */

            'voucher_no' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique(
                    'finance_forms',
                    'voucher_no'
                )->ignore($financeForm->id),
            ],

            'voucher_date' => [
                'required',
                'date',
            ],

            'transaction_type' => [
                'required',
                Rule::in([
                    'journal_entry',
                    'income',
                    'direct_payment',
                    'reimbursement',
                    'disbursement',
                    'cash_advance_settlement',
                ]),
            ],

            'received_from' => [
                'nullable',
                'string',
                'max:255',
            ],

            'amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'amount_in_words' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
        |--------------------------------------------------------------------------
        | Accounting Items
        |--------------------------------------------------------------------------
        */

            'items' => [
                'required',
                'array',
                'min:1',
            ],

            'items.*.date' => [
                'required',
                'date',
            ],

            'items.*.line_type' => [
                'required',
                Rule::in([
                    'advance',
                    'expense',
                    'settlement',
                    'income',
                    'tax',
                    'payable',
                    'bank',
                    'other',
                ]),
            ],

            'items.*.description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'items.*.account_code' => [
                'nullable',
                'string',
                'max:255',
            ],

            'items.*.donor' => [
                'nullable',
                'string',
                'max:255',
            ],

            'items.*.amount' => [
                'required',
                'numeric',
            ],
        ]);


        /*
    |--------------------------------------------------------------------------
    | Clean and calculate items
    |--------------------------------------------------------------------------
    */

        $items = collect($validated['items'])

            ->filter(function ($item) {

                return

                    trim(
                        (string) (
                            $item['description'] ?? ''
                        )
                    ) !== ''

                    ||

                    trim(
                        (string) (
                            $item['account_code'] ?? ''
                        )
                    ) !== ''

                    ||

                    trim(
                        (string) (
                            $item['donor'] ?? ''
                        )
                    ) !== ''

                    ||

                    (float) (
                        $item['amount'] ?? 0
                    ) != 0;
            })

            ->values()

            ->map(function ($item) {

                $amount = round(
                    (float) (
                        $item['amount'] ?? 0
                    ),
                    2
                );


                /*
            |--------------------------------------------------------------------------
            | Positive = Debit
            | Negative = Credit
            |--------------------------------------------------------------------------
            */

                $debit =
                    $amount > 0
                    ? $amount
                    : 0;


                $credit =
                    $amount < 0
                    ? abs($amount)
                    : 0;


                return [

                    'date' =>
                    $item['date'],

                    'line_type' =>
                    $item['line_type'],

                    'description' =>
                    $item['description'] ?? null,

                    'account_code' =>
                    $item['account_code'] ?? null,

                    'donor' =>
                    $item['donor'] ?? null,

                    'amount' =>
                    $amount,

                    'debit' =>
                    $debit,

                    'credit' =>
                    $credit,
                ];
            })

            ->values()

            ->toArray();


        /*
    |--------------------------------------------------------------------------
    | Require at least one real row
    |--------------------------------------------------------------------------
    */

        if (count($items) === 0) {

            return back()
                ->withInput()
                ->withErrors([
                    'items' =>
                    'Please enter at least one accounting entry.',
                ]);
        }


        /*
    |--------------------------------------------------------------------------
    | Recalculate voucher amount
    |--------------------------------------------------------------------------
    */

        $formAmount =
            $this->calculateFormAmount(
                $validated['transaction_type'],
                $items
            );


        /*
    |--------------------------------------------------------------------------
    | Update parent + rebuild accounting items
    |--------------------------------------------------------------------------
    */

        DB::transaction(function () use (
            $financeForm,
            $validated,
            $items,
            $formAmount
        ) {

            /*
        |--------------------------------------------------------------------------
        | Update finance form
        |--------------------------------------------------------------------------
        */

            $financeForm->update([

                'voucher_no' =>
                $validated['voucher_no'] ?? null,

                'voucher_date' =>
                $validated['voucher_date'],

                'transaction_type' =>
                $validated['transaction_type'],

                'received_from' =>
                $validated['received_from'] ?? null,

                'amount' =>
                $formAmount,

                'amount_in_words' =>
                $validated['amount_in_words'] ?? null,

                /*
            | Keep existing status.
            */
                'status' =>
                $financeForm->status,

                /*
            | Keep original creator.
            */
                'created_by' =>
                $financeForm->created_by,
            ]);


            /*
        |--------------------------------------------------------------------------
        | Remove old accounting lines
        |--------------------------------------------------------------------------
        */

            $financeForm->items()->delete();


            /*
        |--------------------------------------------------------------------------
        | Create updated accounting lines
        |--------------------------------------------------------------------------
        */

            foreach (
                $items as $index => $item
            ) {

                $financeForm->items()->create([

                    'sort_order' =>
                    $index + 1,

                    'date' =>
                    $item['date'],

                    'line_type' =>
                    $item['line_type'],

                    'description' =>
                    $item['description'],

                    'account_code' =>
                    $item['account_code'],

                    'donor' =>
                    $item['donor'],

                    'amount' =>
                    $item['amount'],

                    'debit' =>
                    $item['debit'],

                    'credit' =>
                    $item['credit'],
                ]);
            }
        });


        /*
    |--------------------------------------------------------------------------
    | Success
    |--------------------------------------------------------------------------
    */

        return redirect()
            ->route(
                'finance-forms.index'
            )
            ->with(
                'success',
                'Finance form updated successfully.'
            );
    }


    /*
|--------------------------------------------------------------------------
| FORM CONFIGURATION
|--------------------------------------------------------------------------
*/

    private function getFormConfiguration(
        string $transactionType
    ): array {

        return match ($transactionType) {

            /*
        |--------------------------------------------------------------------------
        | JOURNAL ENTRY
        |--------------------------------------------------------------------------
        */

            'journal_entry' => [

                'title' =>
                'Journal Entry',

                'calculationType' =>
                'journal',

                'lineTypes' => [

                    'expense' =>
                    'Expense',

                    'income' =>
                    'Income',

                    'bank' =>
                    'Bank',

                    'tax' =>
                    'Tax',

                    'other' =>
                    'Other',
                ],
            ],


            /*
        |--------------------------------------------------------------------------
        | INCOME
        |--------------------------------------------------------------------------
        */

            'income' => [

                'title' =>
                'Income',

                'calculationType' =>
                'income',

                'lineTypes' => [

                    'income' =>
                    'Income',

                    'bank' =>
                    'Bank',

                    'expense' =>
                    'Expense',

                    'tax' =>
                    'Tax',

                    'other' =>
                    'Other',
                ],
            ],


            /*
        |--------------------------------------------------------------------------
        | DIRECT PAY
        |--------------------------------------------------------------------------
        */

            'direct_payment' => [

                'title' =>
                'Direct Pay',

                'calculationType' =>
                'direct_payment',

                'lineTypes' => [

                    'expense' =>
                    'Expense',

                    'payable' =>
                    'Payable / Cash Payment',

                    'tax' =>
                    'Withholding Tax',

                    'bank' =>
                    'Bank / Cash',

                    'other' =>
                    'Other',
                ],
            ],


            /*
        |--------------------------------------------------------------------------
        | REIMBURSEMENT
        |--------------------------------------------------------------------------
        */

            'reimbursement' => [

                'title' =>
                'Reimbursement',

                'calculationType' =>
                'reimbursement',

                'lineTypes' => [

                    'expense' =>
                    'Expense',

                    'payable' =>
                    'Payable / Reimbursement',

                    'bank' =>
                    'Bank / Cash',

                    'tax' =>
                    'Tax',

                    'other' =>
                    'Other',
                ],
            ],


            /*
        |--------------------------------------------------------------------------
        | DISBURSEMENT
        |--------------------------------------------------------------------------
        */

            'disbursement' => [

                'title' =>
                'Disbursement',

                'calculationType' =>
                'disbursement',

                'lineTypes' => [

                    'advance' =>
                    'Cash Advance',

                    'settlement' =>
                    'Settlement',

                    'expense' =>
                    'Expense',

                    'bank' =>
                    'Bank / Cash',

                    'other' =>
                    'Other',
                ],
            ],


            /*
        |--------------------------------------------------------------------------
        | CASH ADVANCE SETTLEMENT
        |--------------------------------------------------------------------------
        */

            'cash_advance_settlement' => [

                'title' =>
                'Cash Advance Settlement',

                'calculationType' =>
                'cash_advance_settlement',

                'lineTypes' => [

                    'advance' =>
                    'Cash Advance',

                    'settlement' =>
                    'Settlement',

                    'expense' =>
                    'Expense',

                    'bank' =>
                    'Bank / Cash',

                    'other' =>
                    'Other',
                ],
            ],


            /*
        |--------------------------------------------------------------------------
        | DEFAULT
        |--------------------------------------------------------------------------
        */

            default => [

                'title' =>
                'Finance Form',

                'calculationType' =>
                'generic',

                'lineTypes' => [

                    'other' =>
                    'Other',
                ],
            ],
        };
    }


    public function exportPdf(FinanceForm $financeForm)
    {
        $financeForm->load([
            'items',
            'creator',
        ]);

        $pdf = Pdf::loadView(
            'finance-forms.pdf',
            compact('financeForm')
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream(
            'Finance-Form-' .
                ($financeForm->voucher_no ?? $financeForm->id) .
                '.pdf'
        );
    }


    public function template()
    {
        $pdf = Pdf::loadView(
            'finance-forms.template',
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream(
            'Finance-Form-FM02-01'.'.pdf'
        );
    }

}
