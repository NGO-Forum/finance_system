<script>
    document.addEventListener('DOMContentLoaded', function() {

        /* ============================================================
        | FORM ELEMENTS
        | ============================================================ */

        const form =
            document.getElementById('financeForm');

        const itemsBody =
            document.getElementById('itemsBody');

        const addItem =
            document.getElementById('addItem');

        const itemTemplate =
            document.getElementById('itemTemplate');

        const mainAmount =
            document.getElementById('mainAmount');

        const amountInWords =
            document.getElementById('amountInWords');

        const totalAmount =
            document.getElementById('totalAmount');

        const totalDebit =
            document.getElementById('totalDebit');

        const totalCredit =
            document.getElementById('totalCredit');

        const balanceStatus =
            document.getElementById('balanceStatus');


        /* ============================================================
        | TRANSACTION TYPE
        |
        | Example:
        |
        | data-calculation-type="income"
        | data-calculation-type="direct_payment"
        | data-calculation-type="reimbursement"
        | data-calculation-type="disbursement"
        | data-calculation-type="cash_advance_settlement"
        | data-calculation-type="journal"
        |
        | ============================================================ */

        const calculationType =
            String(
                form?.dataset?.calculationType || 'generic'
            )
            .toLowerCase()
            .trim();


        /* ============================================================
        | SAFETY CHECK
        | ============================================================ */

        if (!itemsBody) {
            return;
        }


        /* ============================================================
        | BASIC HELPERS
        | ============================================================ */

        function number(value) {

            if (
                value === null ||
                value === undefined ||
                value === ''
            ) {
                return 0;
            }


            const parsed =
                parseFloat(
                    String(value)
                    .replace(/,/g, '')
                    .trim()
                );


            return Number.isFinite(parsed) ?
                parsed :
                0;

        }


        function money(value) {

            return number(value).toLocaleString(
                'en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }
            );

        }


        function rows() {

            return Array.from(
                itemsBody.querySelectorAll(
                    '.item-row'
                )
            );

        }


        function normalizeLineType(value) {

            return String(value || '')
                .toLowerCase()
                .trim()
                .replace(/[-\s\/]+/g, '_');

        }


        /* ============================================================
        | UPDATE ROW NUMBERS
        | ============================================================ */

        function updateNames() {

            rows().forEach(
                function(row, index) {

                    row.dataset.index =
                        index;


                    const rowNumber =
                        row.querySelector(
                            '.row-number'
                        );


                    if (rowNumber) {

                        rowNumber.textContent =
                            index + 1;

                    }


                    row.querySelectorAll(
                        '[name]'
                    ).forEach(
                        function(element) {

                            const name =
                                element.getAttribute(
                                    'name'
                                );


                            if (!name) {
                                return;
                            }


                            element.setAttribute(
                                'name',
                                name.replace(
                                    /items\[\d+\]/,
                                    `items[${index}]`
                                )
                            );

                        }
                    );

                }
            );

        }


        /* ============================================================
        | CALCULATE ONE ACCOUNTING ROW
        |
        | Positive amount:
        |
        | Debit
        |
        | Negative amount:
        |
        | Credit
        |
        | Example:
        |
        | 150   => Debit 150 / Credit 0
        | -170  => Debit 0   / Credit 170
        |
        | ============================================================ */

        function calculateRow(row) {

            const amountInput =
                row.querySelector(
                    '.item-amount'
                );


            if (!amountInput) {

                return {
                    amount: 0,
                    debit: 0,
                    credit: 0
                };

            }


            const amount =
                number(
                    amountInput.value
                );


            const debit =
                amount > 0 ?
                amount :
                0;


            const credit =
                amount < 0 ?
                Math.abs(amount) :
                0;


            /*
            |--------------------------------------------------------------------------
            | Optional preview columns
            |--------------------------------------------------------------------------
            */

            const debitPreview =
                row.querySelector(
                    '.item-debit-preview'
                );


            const creditPreview =
                row.querySelector(
                    '.item-credit-preview'
                );


            if (debitPreview) {

                debitPreview.textContent =
                    money(debit);

            }


            if (creditPreview) {

                creditPreview.textContent =
                    money(credit);

            }


            return {
                amount,
                debit,
                credit
            };

        }


        /* ============================================================
        | GET ALL ROW DATA
        | ============================================================ */

        function getTransactionData() {

            return rows().map(
                function(row) {

                    const result =
                        calculateRow(row);


                    const lineType =
                        normalizeLineType(
                            row.querySelector(
                                '.item-line-type'
                            )?.value
                        );


                    return {
                        ...result,
                        lineType,
                        row
                    };

                }
            );

        }


        /* ============================================================
        | SUM POSITIVE AMOUNTS
        | ============================================================ */

        function sumPositive(
            data,
            types
        ) {

            return data
                .filter(
                    function(item) {

                        return (
                            types.includes(
                                item.lineType
                            ) &&
                            item.amount > 0
                        );

                    }
                )
                .reduce(
                    function(total, item) {

                        return total +
                            item.amount;

                    },
                    0
                );

        }


        /* ============================================================
        | SUM NEGATIVE AMOUNTS
        |
        | Returned as positive number.
        | ============================================================ */

        function sumNegative(
            data,
            types
        ) {

            return data
                .filter(
                    function(item) {

                        return (
                            types.includes(
                                item.lineType
                            ) &&
                            item.amount < 0
                        );

                    }
                )
                .reduce(
                    function(total, item) {

                        return total +
                            Math.abs(
                                item.amount
                            );

                    },
                    0
                );

        }


        /* ============================================================
        | JOURNAL ENTRY TOTAL
        |
        | Debit and Credit are normally equal.
        |
        | Total Amount uses ONE side only.
        |
        | NEVER:
        |
        | debit + credit
        |
        | because that doubles the transaction.
        | ============================================================ */

        function calculateJournalAmount(data) {

            let debit = 0;
            let credit = 0;


            data.forEach(
                function(item) {

                    debit +=
                        item.debit;


                    credit +=
                        item.credit;

                }
            );

            /*
            |--------------------------------------------------------------------------
            | Journal Entry
            |
            | Debit and Credit represent the same transaction.
            |
            | Therefore:
            |
            | Total Amount = ONE SIDE ONLY
            |
            | NOT:
            |
            | Debit + Credit
            |--------------------------------------------------------------------------
            */


            if (debit > 0) {

                return debit;

            }


            return 0;

        }


        /* ============================================================
        | INCOME TOTAL
        |
        | Example:
        |
        | Income       1,000
        | Bank charge      8
        |
        | Total:
        |
        | 1,000 - 8 = 992
        |
        | ============================================================ */

        function calculateIncomeAmount(data) {

            const income =
                sumPositive(
                    data,
                    [
                        'income',
                        'grant',
                        'donor_income',
                        'revenue'
                    ]
                );


            const charges =
                sumPositive(
                    data,
                    [
                        'expense',
                        'tax',
                        'bank',
                        'bank_charge',
                        'bank_charges',
                        'service_charge',
                        'service_charges',
                        'withholding_tax'
                    ]
                );


            return Math.max(
                income - charges,
                0
            );

        }


        /* ============================================================
        | DIRECT PAYMENT TOTAL
        |
        | We look for the actual payment amount.
        |
        | Example:
        |
        | Expense payment      -1,020
        | Withholding tax        -180
        |
        | Total Amount = 1,020
        |
        | Do NOT use:
        |
        | Debit + Credit
        | ============================================================ */

        function calculateDirectPaymentAmount(data) {

            /*
            |--------------------------------------------------------------------------
            | Explicit payment rows
            |--------------------------------------------------------------------------
            */

            const paymentRows =
                data.filter(
                    function(item) {

                        return [
                            'payment',
                            'payable',
                            'direct_payment',
                            'direct_pay',
                            'supplier_payment',
                            'supplier',
                            'consultant_payment',
                            'consultant'
                        ].includes(
                            item.lineType
                        );

                    }
                );


            const negativePayment =
                paymentRows
                .filter(
                    function(item) {

                        return item.amount < 0;

                    }
                )
                .sort(
                    function(a, b) {

                        return (
                            Math.abs(
                                b.amount
                            ) -
                            Math.abs(
                                a.amount
                            )
                        );

                    }
                )[0];


            if (negativePayment) {

                return Math.abs(
                    negativePayment.amount
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Negative expense
            |--------------------------------------------------------------------------
            */

            const negativeExpense =
                data
                .filter(
                    function(item) {

                        return [
                                'expense',
                                'payment_expense'
                            ].includes(
                                item.lineType
                            ) &&
                            item.amount < 0;

                    }
                )
                .sort(
                    function(a, b) {

                        return (
                            Math.abs(
                                b.amount
                            ) -
                            Math.abs(
                                a.amount
                            )
                        );

                    }
                )[0];


            if (negativeExpense) {

                return Math.abs(
                    negativeExpense.amount
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Fallback to positive expense
            |--------------------------------------------------------------------------
            */

            const positiveExpense =
                sumPositive(
                    data,
                    [
                        'expense',
                        'payment',
                        'payable'
                    ]
                );


            if (positiveExpense > 0) {

                return positiveExpense;

            }


            /*
            |--------------------------------------------------------------------------
            | Last fallback
            |--------------------------------------------------------------------------
            */

            const negative =
                data
                .filter(
                    function(item) {

                        return (
                            item.amount < 0 &&
                            ![
                                'tax',
                                'withholding_tax',
                                'bank',
                                'bank_charge'
                            ].includes(
                                item.lineType
                            )
                        );

                    }
                )
                .sort(
                    function(a, b) {

                        return (
                            Math.abs(
                                b.amount
                            ) -
                            Math.abs(
                                a.amount
                            )
                        );

                    }
                )[0];


            return negative ?
                Math.abs(
                    negative.amount
                ) :
                0;

        }


        /* ============================================================
        | REIMBURSEMENT TOTAL
        |
        | Example:
        |
        | Expense 27
        | Expense 20
        |
        | Total = 47
        |
        | ============================================================ */

        function calculateReimbursementAmount(data) {

            return sumPositive(
                data,
                [
                    'expense',
                    'reimbursement',
                    'reimbursement_expense'
                ]
            );

        }


        /* ============================================================
        | DISBURSEMENT TOTAL
        |
        | Example:
        |
        | Cash Advance = 150
        | Expense      = 170
        |
        | Additional Disbursement:
        |
        | 170 - 150 = 20
        |
        | ============================================================ */

        function calculateDisbursementAmount(data) {

            let advance = 0;

            let expense = 0;


            data.forEach(
                function(item) {

                    /*
                    |--------------------------------------------------------------------------
                    | Cash Advance
                    |--------------------------------------------------------------------------
                    */

                    if (
                        [
                            'advance',
                            'cash_advance'
                        ].includes(
                            item.lineType
                        ) &&
                        item.amount > 0
                    ) {

                        advance +=
                            item.amount;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Expense
                    |--------------------------------------------------------------------------
                    */

                    if (
                        item.lineType ===
                        'expense' &&
                        item.amount > 0
                    ) {

                        expense +=
                            item.amount;

                    }

                }
            );


            return Math.max(
                expense - advance,
                0
            );

        }


        /* ============================================================
        | CASH ADVANCE SETTLEMENT TOTAL
        |
        | THIS IS THE IMPORTANT ONE.
        |
        | Example:
        |
        | 1. Cash Advance
        |       +150
        |
        | 2. Settlement
        |       +20
        |
        | 3. Settlement
        |       -170
        |
        | 4. Expense
        |       +150
        |
        | 5. Expense settlement
        |       -150
        |
        |
        | Available advance:
        |
        |       150 + 20
        | |     = 170
        |
        | Expense:
        |
        |       150
        |
        | Refund:
        |
        |       170 - 150
        |       = 20
        |
        | Total Amount = 20.00
        |
        | ============================================================ */

        function calculateCashAdvanceSettlementAmount(data) {

            let advance = 0;

            let expense = 0;

            let settlementIncrease = 0;


            data.forEach(
                function(item) {

                    /*
                    |--------------------------------------------------------------------------
                    | Cash Advance
                    |--------------------------------------------------------------------------
                    */

                    if (
                        [
                            'advance',
                            'cash_advance'
                        ].includes(
                            item.lineType
                        ) &&
                        item.amount > 0
                    ) {

                        advance +=
                            item.amount;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Expense
                    |--------------------------------------------------------------------------
                    */

                    if (
                        item.lineType ===
                        'expense' &&
                        item.amount > 0
                    ) {

                        expense +=
                            item.amount;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Positive Settlement
                    |
                    | IMPORTANT:
                    |
                    | Settlement +20 increases the available
                    | cash advance.
                    |
                    |--------------------------------------------------------------------------
                    */

                    if (
                        item.lineType ===
                        'settlement' &&
                        item.amount > 0
                    ) {

                        settlementIncrease +=
                            item.amount;

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Total Available Advance
            |--------------------------------------------------------------------------
            */

            const totalAdvance =
                advance +
                settlementIncrease;


            /*
            |--------------------------------------------------------------------------
            | Difference
            |
            | Positive:
            |
            | Refund
            |
            | Negative:
            |
            | Additional Disbursement
            |--------------------------------------------------------------------------
            */

            const difference =
                totalAdvance -
                expense;


            return Math.abs(
                difference
            );

        }


        /* ============================================================
        | REFUND TOTAL
        |
        | Same calculation as Cash Advance Settlement.
        |
        | Advance + positive Settlement - Expense
        |
        | ============================================================ */

        function calculateRefundAmount(data) {

            return calculateCashAdvanceSettlementAmount(
                data
            );

        }


        /* ============================================================
        | GENERIC TOTAL
        |
        | Used when no special transaction type is selected.
        | ============================================================ */

        function calculateGenericAmount(data) {

            return data
                .filter(
                    function(item) {

                        return item.amount > 0;

                    }
                )
                .reduce(
                    function(total, item) {

                        return total +
                            item.amount;

                    },
                    0
                );

        }


        /* ============================================================
        | MAIN TOTAL AMOUNT
        |
        | This determines the transaction total.
        | ============================================================ */

        function calculateFormAmount() {

            const data =
                getTransactionData();


            switch (calculationType) {


                /* ====================================================
                | JOURNAL ENTRY
                ==================================================== */

                case 'journal':
                case 'journal_entry':

                    return calculateJournalAmount(
                        data
                    );


                    /* ====================================================
                    | INCOME
                    ==================================================== */

                case 'income':

                    return calculateIncomeAmount(
                        data
                    );


                    /* ====================================================
                    | DIRECT PAYMENT
                    ==================================================== */

                case 'direct_payment':
                case 'direct_pay':
                case 'direct_payment_deposit':
                case 'direct_pay_deposit':

                    return calculateDirectPaymentAmount(
                        data
                    );


                    /* ====================================================
                    | REIMBURSEMENT
                    ==================================================== */

                case 'reimbursement':
                case 'reimbursment':

                    return calculateReimbursementAmount(
                        data
                    );


                    /* ====================================================
                    | DISBURSEMENT
                    ==================================================== */

                case 'disbursement':
                case 'cash_advance_disbursement':

                    return calculateDisbursementAmount(
                        data
                    );


                    /* ====================================================
                    | CASH ADVANCE SETTLEMENT
                    ==================================================== */

                case 'cash_advance_settlement':
                case 'cash_advance_settle':
                case 'settlement':

                    return calculateCashAdvanceSettlementAmount(
                        data
                    );


                    /* ====================================================
                    | REFUND
                    ==================================================== */

                case 'refund':
                case 'cash_advance_refund':

                    return calculateRefundAmount(
                        data
                    );


                    /* ====================================================
                    | DEFAULT
                    ==================================================== */

                default:

                    return calculateGenericAmount(
                        data
                    );

            }

        }


        /* ============================================================
        | UPDATE MAIN AMOUNT
        | ============================================================ */

        function updateMainAmount() {

            // Journal Entry has no main transaction amount.
            if (
                calculationType === 'journal' ||
                calculationType === 'journal_entry'
            ) {
                if (mainAmount) {
                    mainAmount.value = '0.00';
                }

                if (amountInWords) {
                    amountInWords.value = '';
                }

                return;
            }

            const value =
                calculateFormAmount();

            if (mainAmount) {
                mainAmount.value =
                    value.toFixed(2);
            }

            updateAmountWords(value);
        }


        /* ============================================================
        | UPDATE TOTALS
        |
        | IMPORTANT:
        |
        | Total Amount
        |     = transaction calculation
        |
        | Total Debit
        |     = accounting debit
        |
        | Total Credit
        |     = accounting credit
        |
        | NEVER:
        |
        | Total Amount = Debit + Credit
        | ============================================================ */

        function calculateTotals() {

            let debit = 0;

            let credit = 0;


            rows().forEach(
                function(row) {

                    const result =
                        calculateRow(row);


                    debit +=
                        result.debit;


                    credit +=
                        result.credit;

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Transaction Amount
            |--------------------------------------------------------------------------
            */

            const amount =
                calculateFormAmount();


            /*
            |--------------------------------------------------------------------------
            | TOTAL AMOUNT
            |--------------------------------------------------------------------------
            */

            if (totalAmount) {

                if (
                    calculationType === 'journal' ||
                    calculationType === 'journal_entry'
                ) {
                    totalAmount.textContent = '—';
                } else {
                    totalAmount.textContent = money(amount);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | TOTAL DEBIT
            |--------------------------------------------------------------------------
            */

            if (totalDebit) {

                totalDebit.textContent =
                    money(debit);

            }


            /*
            |--------------------------------------------------------------------------
            | TOTAL CREDIT
            |--------------------------------------------------------------------------
            */

            if (totalCredit) {

                totalCredit.textContent =
                    money(credit);

            }


            /*
            |--------------------------------------------------------------------------
            | BALANCE STATUS
            |--------------------------------------------------------------------------
            */

            updateBalanceStatus(
                debit,
                credit
            );


            /*
            |--------------------------------------------------------------------------
            | MAIN AMOUNT
            |--------------------------------------------------------------------------
            */

            updateMainAmount();


            /*
            |--------------------------------------------------------------------------
            | SPECIAL SUMMARY
            |--------------------------------------------------------------------------
            */

            updateSpecialSummary();

        }


        /* ============================================================
        | BALANCE STATUS
        | ============================================================ */

        function updateBalanceStatus(
            debit,
            credit
        ) {

            if (!balanceStatus) {
                return;
            }


            const difference =
                Math.abs(
                    debit - credit
                );


            /*
            |--------------------------------------------------------------------------
            | Empty
            |--------------------------------------------------------------------------
            */

            if (
                debit === 0 &&
                credit === 0
            ) {

                balanceStatus.className =
                    'mt-4 rounded-xl bg-gray-100 px-4 py-3 text-sm font-semibold text-gray-500';

                balanceStatus.textContent =
                    'Add accounting entries.';

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Balanced
            |--------------------------------------------------------------------------
            */

            if (
                difference < 0.01
            ) {

                balanceStatus.className =
                    'mt-4 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700';

                balanceStatus.textContent =
                    '✓ Accounting entries are balanced.';

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Not balanced
            |--------------------------------------------------------------------------
            */

            balanceStatus.className =
                'mt-4 rounded-xl bg-red-50 px-4 py-3 text-sm font-semibold text-red-700';

            balanceStatus.textContent =
                'Debit and Credit difference: ' +
                money(difference);

        }


        /* ============================================================
        | SPECIAL SUMMARY
        |
        | Used by:
        |
        | - Disbursement
        | - Cash Advance Settlement
        | - Refund
        |
        | ============================================================ */

        function updateSpecialSummary() {

            const isDisbursement = [
                'disbursement',
                'cash_advance_disbursement'
            ].includes(
                calculationType
            );


            const isSettlement = [
                'cash_advance_settlement',
                'cash_advance_settle',
                'settlement',
                'refund',
                'cash_advance_refund'
            ].includes(
                calculationType
            );


            if (
                !isDisbursement &&
                !isSettlement
            ) {

                return;

            }


            let advance = 0;

            let expense = 0;

            let settlementIncrease = 0;


            rows().forEach(
                function(row) {

                    const result =
                        calculateRow(row);


                    const lineType =
                        normalizeLineType(
                            row.querySelector(
                                '.item-line-type'
                            )?.value
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | CASH ADVANCE
                    |--------------------------------------------------------------------------
                    */

                    if (
                        [
                            'advance',
                            'cash_advance'
                        ].includes(
                            lineType
                        ) &&
                        result.amount > 0
                    ) {

                        advance +=
                            result.amount;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | EXPENSE
                    |--------------------------------------------------------------------------
                    */

                    if (
                        lineType ===
                        'expense' &&
                        result.amount > 0
                    ) {

                        expense +=
                            result.amount;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | POSITIVE SETTLEMENT
                    |--------------------------------------------------------------------------
                    */

                    if (
                        lineType ===
                        'settlement' &&
                        result.amount > 0
                    ) {

                        settlementIncrease +=
                            result.amount;

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | TOTAL AVAILABLE ADVANCE
            |--------------------------------------------------------------------------
            */

            const totalAdvance =
                advance +
                settlementIncrease;


            /*
            |--------------------------------------------------------------------------
            | DIFFERENCE
            |--------------------------------------------------------------------------
            */

            const difference =
                totalAdvance -
                expense;


            /*
            |--------------------------------------------------------------------------
            | REFUND
            |
            | Advance > Expense
            |--------------------------------------------------------------------------
            */

            const refund =
                Math.max(
                    difference,
                    0
                );


            /*
            |--------------------------------------------------------------------------
            | ADDITIONAL DISBURSEMENT
            |
            | Expense > Advance
            |--------------------------------------------------------------------------
            */

            const additionalDisbursement =
                Math.max(
                    -difference,
                    0
                );


            /*
            |--------------------------------------------------------------------------
            | ELEMENTS
            |--------------------------------------------------------------------------
            */

            const advanceDisplay =
                document.getElementById(
                    'advanceDisplay'
                );


            const expenseDisplay =
                document.getElementById(
                    'expenseDisplay'
                );


            const refundDisplay =
                document.getElementById(
                    'refundDisplay'
                );


            const disbursementDisplay =
                document.getElementById(
                    'disbursementDisplay'
                );


            const settlementDisplay =
                document.getElementById(
                    'settlementDisplay'
                );


            const differenceDisplay =
                document.getElementById(
                    'differenceDisplay'
                );


            const totalAdvanceDisplay =
                document.getElementById(
                    'totalAdvanceDisplay'
                );


            /*
            |--------------------------------------------------------------------------
            | ADVANCE
            |--------------------------------------------------------------------------
            */

            if (advanceDisplay) {

                advanceDisplay.textContent =
                    money(advance);

            }


            /*
            |--------------------------------------------------------------------------
            | SETTLEMENT
            |--------------------------------------------------------------------------
            */

            if (settlementDisplay) {

                settlementDisplay.textContent =
                    money(
                        settlementIncrease
                    );

            }


            /*
            |--------------------------------------------------------------------------
            | TOTAL AVAILABLE ADVANCE
            |--------------------------------------------------------------------------
            */

            if (totalAdvanceDisplay) {

                totalAdvanceDisplay.textContent =
                    money(
                        totalAdvance
                    );

            }


            /*
            |--------------------------------------------------------------------------
            | EXPENSE
            |--------------------------------------------------------------------------
            */

            if (expenseDisplay) {

                expenseDisplay.textContent =
                    money(expense);

            }


            /*
            |--------------------------------------------------------------------------
            | REFUND
            |--------------------------------------------------------------------------
            */

            if (refundDisplay) {

                refundDisplay.textContent =
                    money(refund);

            }


            /*
            |--------------------------------------------------------------------------
            | ADDITIONAL DISBURSEMENT
            |--------------------------------------------------------------------------
            */

            if (disbursementDisplay) {

                disbursementDisplay.textContent =
                    money(
                        additionalDisbursement
                    );

            }


            /*
            |--------------------------------------------------------------------------
            | DIFFERENCE
            |--------------------------------------------------------------------------
            */

            if (differenceDisplay) {

                differenceDisplay.textContent =
                    money(
                        Math.abs(
                            difference
                        )
                    );

            }

        }


        /* ============================================================
        | NUMBER TO WORDS
        | ============================================================ */

        const ones = [

            '',
            'One',
            'Two',
            'Three',
            'Four',
            'Five',
            'Six',
            'Seven',
            'Eight',
            'Nine',
            'Ten',
            'Eleven',
            'Twelve',
            'Thirteen',
            'Fourteen',
            'Fifteen',
            'Sixteen',
            'Seventeen',
            'Eighteen',
            'Nineteen'

        ];


        const tens = [

            '',
            '',
            'Twenty',
            'Thirty',
            'Forty',
            'Fifty',
            'Sixty',
            'Seventy',
            'Eighty',
            'Ninety'

        ];


        function numberToWords(value) {

            value =
                Math.floor(
                    Math.abs(
                        number(value)
                    )
                );


            if (value === 0) {

                return 'Zero';

            }


            if (value < 20) {

                return ones[value];

            }


            if (value < 100) {

                return (
                    tens[
                        Math.floor(
                            value / 10
                        )
                    ] +
                    (
                        value % 10 ?
                        ' ' +
                        ones[
                            value % 10
                        ] :
                        ''
                    )
                );

            }


            if (value < 1000) {

                return (
                    ones[
                        Math.floor(
                            value / 100
                        )
                    ] +
                    ' Hundred' +
                    (
                        value % 100 ?
                        ' ' +
                        numberToWords(
                            value % 100
                        ) :
                        ''
                    )
                );

            }


            if (value < 1000000) {

                return (
                    numberToWords(
                        Math.floor(
                            value / 1000
                        )
                    ) +
                    ' Thousand' +
                    (
                        value % 1000 ?
                        ' ' +
                        numberToWords(
                            value % 1000
                        ) :
                        ''
                    )
                );

            }


            if (value < 1000000000) {

                return (
                    numberToWords(
                        Math.floor(
                            value / 1000000
                        )
                    ) +
                    ' Million' +
                    (
                        value % 1000000 ?
                        ' ' +
                        numberToWords(
                            value % 1000000
                        ) :
                        ''
                    )
                );

            }


            return (
                numberToWords(
                    Math.floor(
                        value / 1000000000
                    )
                ) +
                ' Billion'
            );

        }


        /* ============================================================
        | AMOUNT IN WORDS
        | ============================================================ */

        function updateAmountWords(value) {

            if (!amountInWords) {
                return;
            }


            value =
                number(value);


            if (value <= 0) {

                amountInWords.value =
                    '';

                return;

            }


            const whole =
                Math.floor(value);


            const cents =
                Math.round(
                    (
                        value -
                        whole
                    ) * 100
                );


            let text =
                numberToWords(
                    whole
                ) +
                ' US Dollars';


            if (cents > 0) {

                text +=
                    ' and ' +
                    numberToWords(
                        cents
                    ) +
                    ' Cents';

            }


            text +=
                ' Only';


            amountInWords.value =
                text;

        }


        /* ============================================================
        | ADD ACCOUNTING ENTRY
        | ============================================================ */

        if (addItem && itemTemplate) {

            addItem.addEventListener(
                'click',
                function() {

                    const index =
                        rows().length;


                    const html =
                        itemTemplate.innerHTML
                        .replaceAll(
                            '__INDEX__',
                            index
                        );


                    itemsBody.insertAdjacentHTML(
                        'beforeend',
                        html
                    );


                    updateNames();

                    calculateTotals();

                }
            );

        }


        /* ============================================================
        | REMOVE ACCOUNTING ENTRY
        | ============================================================ */

        itemsBody.addEventListener(
            'click',
            function(event) {

                const button =
                    event.target.closest(
                        '.remove-row'
                    );


                if (!button) {
                    return;
                }


                const currentRows =
                    rows();


                /*
                |--------------------------------------------------------------------------
                | Do not allow all rows to be removed.
                |--------------------------------------------------------------------------
                */

                if (
                    currentRows.length <= 1
                ) {

                    const row =
                        currentRows[0];


                    if (row) {

                        row.querySelectorAll(
                            'input'
                        ).forEach(
                            function(input) {

                                if (
                                    input.type !==
                                    'date'
                                ) {

                                    input.value =
                                        '';

                                }

                            }
                        );


                        row.querySelectorAll(
                            'select'
                        ).forEach(
                            function(select) {

                                select.selectedIndex =
                                    0;

                            }
                        );

                    }


                    calculateTotals();

                    return;

                }


                const row =
                    button.closest(
                        '.item-row'
                    );


                if (row) {

                    row.remove();

                }


                updateNames();

                calculateTotals();

            }
        );


        /* ============================================================
        | AMOUNT CHANGE
        | ============================================================ */

        itemsBody.addEventListener(
            'input',
            function(event) {

                if (
                    event.target.matches(
                        '.item-amount'
                    )
                ) {

                    calculateTotals();

                }

            }
        );


        /* ============================================================
        | LINE TYPE CHANGE
        | ============================================================ */

        itemsBody.addEventListener(
            'change',
            function(event) {

                if (
                    event.target.matches(
                        '.item-line-type'
                    )
                ) {

                    calculateTotals();

                }

            }
        );


        /* ============================================================
        | INITIALIZE
        | ============================================================ */

        updateNames();

        calculateTotals();

    });
</script>
