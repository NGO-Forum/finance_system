<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\FundRequestController;
use App\Http\Controllers\ExpenditureSummaryController;
use App\Http\Controllers\DonorLogoController;
use App\Http\Controllers\FinanceFormController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendantListController;
use App\Http\Controllers\AttendantRegistrationController;
use App\Http\Controllers\AllowanceFormController;
use App\Http\Controllers\AllowanceParticipantController;
use App\Http\Controllers\Auth\MicrosoftAuthController;
use App\Http\Controllers\PurchaseRequestController;
use App\Http\Controllers\DsaClaimController;
use App\Http\Controllers\PaymentSlipController;
use App\Http\Controllers\VerbalQuoteController;
use App\Http\Controllers\QuotationAnalysisController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\GoodsReceivedNoteController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\InvoiceController;



Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/auth/microsoft', [MicrosoftAuthController::class, 'redirect'])
    ->name('auth.microsoft');

Route::get('/auth/microsoft/callback', [MicrosoftAuthController::class, 'callback'])
    ->name('auth.callback');

// Public registration
Route::get(
    '/attendance/register/{token}',
    [AttendantRegistrationController::class, 'create']
)->name('attendant.register');

Route::post(
    '/attendance/register/{token}',
    [AttendantRegistrationController::class, 'store']
)->name('attendant.register.store');

// Public Thank You page
Route::get('/attendance/thank-you', function () {
    return view('attendant-registrations.thank-you');
})->name('attendant.thank-you');

// Public Registration Full page
Route::get('/attendance/full', function () {
    return view('attendant-registrations.registration-full');
})->name('attendant.registration.full');

Route::post(
    '/attendant-lists/template/export',
    [AttendantListController::class, 'exportPdf']
)->name('attendant-lists.template.export');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('fund-requests', FundRequestController::class);
    Route::resource('expenditure-summaries', ExpenditureSummaryController::class);
    Route::prefix('finance-forms')
        ->name('finance-forms.')
        ->group(function () {

            Route::get(
                '/',
                [FinanceFormController::class, 'index']
            )->name('index');

            Route::get(
                '/journal-entry/create',
                [FinanceFormController::class, 'createJournalEntry']
            )->name('journal-entry.create');

            Route::get(
                '/income/create',
                [FinanceFormController::class, 'createIncome']
            )->name('income.create');

            Route::get(
                '/direct-pay/create',
                [FinanceFormController::class, 'createDirectPay']
            )->name('direct-pay.create');

            Route::get(
                '/reimbursement/create',
                [FinanceFormController::class, 'createReimbursement']
            )->name('reimbursement.create');

            Route::get(
                '/disbursement/create',
                [FinanceFormController::class, 'createDisbursement']
            )->name('disbursement.create');

            Route::get(
                '/cash-advance-settlement/create',
                [FinanceFormController::class, 'createCashAdvanceSettlement']
            )->name('cash-advance-settlement.create');


            Route::get(
                '/{financeForm}',
                [FinanceFormController::class, 'show']
            )->name('show');

            Route::get(
                '/{financeForm}/edit',
                [FinanceFormController::class, 'edit']
            )->name('edit');

            Route::put(
                '/{financeForm}',
                [FinanceFormController::class, 'update']
            )->name('update');

            Route::delete(
                '/{financeForm}',
                [FinanceFormController::class, 'destroy']
            )->name('destroy');

            Route::post(
                '/',
                [FinanceFormController::class, 'store']
            )->name('store');

            Route::get(
                '/finance-forms/{financeForm}/pdf',
                [FinanceFormController::class, 'pdf']
            )->name('finance-forms.pdf');
        });
    Route::resource('donor-logos', DonorLogoController::class);
    Route::resource('attendant-lists', AttendantListController::class);
    Route::resource('allowance-forms', AllowanceFormController::class);
    Route::resource('purchase-requests', PurchaseRequestController::class);
    Route::resource('dsa-claims', DsaClaimController::class);
    Route::resource('verbal-quotes', VerbalQuoteController::class);
    Route::resource('quotation-analyses', QuotationAnalysisController::class);
    Route::resource('purchase-orders', PurchaseOrderController::class);
    Route::resource('goods-received-notes', GoodsReceivedNoteController::class);
    Route::resource('invoices', InvoiceController::class);


    // QuotationAnalysis
    Route::get(
        '/quotation-analyses/{quotationAnalysis}/pdf',
        [QuotationAnalysisController::class, 'pdf']
    )->name('quotation-analyses.pdf');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');

    // Fund Request
    Route::post(
        '/fund-requests/{fundRequest}/approve-manager',
        [FundRequestController::class, 'approveByManager']
    )->name('fund-requests.approve-manager');

    Route::post(
        '/fund-requests/{fundRequest}/approve-ed',
        [FundRequestController::class, 'approveByED']
    )->name('fund-requests.approve-ed');

    Route::post(
        '/fund-requests/{fundRequest}/reject',
        [FundRequestController::class, 'reject']
    )->name('fund-requests.reject');

    Route::get(
        '/fund-requests/{fundRequest}/pdf',
        [FundRequestController::class, 'exportPdf']
    )->name('fund-requests.pdf');


    // Exp Summaries
    Route::post(
        '/expenditure-summaries/{summary}/approve-manager',
        [ExpenditureSummaryController::class, 'approveByManager']
    )->name('expenditure-summaries.approve-manager');

    Route::post(
        '/expenditure-summaries/{summary}/approve-ed',
        [ExpenditureSummaryController::class, 'approveByED']
    )->name('expenditure-summaries.approve-ed');

    Route::get(
        '/expenditure-summaries/{summary}/pdf',
        [ExpenditureSummaryController::class, 'exportPdf']
    )->name('expenditure-summaries.pdf');


    // Form Finance
    Route::get(
        'finance-forms/{financeForm}/pdf',
        [FinanceFormController::class, 'exportPdf']
    )->name('finance-forms.pdf');


    // Attendant list
    Route::get(
        '/attendant-lists/{attendantList}/registrations',
        [AttendantRegistrationController::class, 'index']
    )->name('attendant-registrations.index');

    Route::get(
        '/attendant-registrations/{attendantRegistration}',
        [AttendantRegistrationController::class, 'show']
    )->name('attendant-registrations.show');

    Route::delete(
        '/attendant-registrations/{attendantRegistration}',
        [AttendantRegistrationController::class, 'destroy']
    )->name('attendant-registrations.destroy');

    Route::get(
        '/attendant-lists/{attendantList}/pdf',
        [AttendantRegistrationController::class, 'exportPdf']
    )->name('attendant-registrations.pdf');

    Route::get(
        '/attendant-lists/{attendantList}/qr-preview',
        [AttendantListController::class, 'previewQrCard']
    )->name('attendant-lists.qr-preview');


    // Allowance list
    Route::post(
        '/allowance-forms/{allowance}/import',
        [AllowanceParticipantController::class, 'import']
    )->name('allowance.import');

    Route::post(
        '/allowance-forms/{allowance}/participant',
        [AllowanceParticipantController::class, 'store']
    )->name('allowance.participant.store');

    Route::put(
        '/allowance-participants/{participant}',
        [AllowanceParticipantController::class, 'update']
    )->name('allowance.participant.update');

    Route::delete(
        '/allowance-participants/{participant}',
        [AllowanceParticipantController::class, 'destroy']
    )->name('allowance.participant.destroy');

    Route::post(
        '/allowance-forms/{allowance}/save-amount',
        [AllowanceParticipantController::class, 'saveAmount']
    )->name('allowance.saveAmount');

    Route::get(
        '/allowance-forms/{allowanceForm}/export-pdf',
        [AllowanceFormController::class, 'exportPdf']
    )->name('allowance-forms.PDF');

    Route::get('/allowance-forms/{allowance}/print', [AllowanceFormController::class, 'print'])
        ->name('allowance-forms.Print');


    // PurchaseRequest
    Route::post(
        '/purchase-requests/{purchaseRequest}/review',
        [PurchaseRequestController::class, 'review']
    )->name('purchase-requests.review');

    Route::post(
        '/purchase-requests/{purchaseRequest}/approve',
        [PurchaseRequestController::class, 'approve']
    )->name('purchase-requests.approve');

    Route::get(
        '/purchase-requests/{purchaseRequest}/pdf',
        [PurchaseRequestController::class, 'exportPdf']
    )
        ->name('purchase-requests.pdf');

    // DSA Form
    Route::get(
        '/dsa-claims/{dsaClaim}/pdf',
        [DsaClaimController::class, 'exportPdf']
    )->name('dsa-claims.pdf');

    // Payment Slipt
    Route::get('/payment-slip', [PaymentSlipController::class, 'index'])
        ->name('payment-slips.index');


    // Receipt
    Route::get('/receipts', [ReceiptController::class, 'index'])
        ->name('receipts.index');


    // Verbal
    Route::get('/verbal-quotes/{verbalQuote}/pdf', [VerbalQuoteController::class, 'pdf'])
        ->name('verbal-quotes.pdf');


    // Purchase Order
    Route::get(
        'purchase-orders/{purchaseOrder}/pdf',
        [PurchaseOrderController::class, 'pdf']
    )->name('purchase-orders.pdf');


    // Good Note
    Route::get(
        '/goods-received-notes/{goodsReceivedNote}/pdf',
        [GoodsReceivedNoteController::class, 'pdf']
    )->name('goods-received-notes.pdf');


    // Invoice
    Route::get(
        '/invoices/{invoice}/pdf',
        [InvoiceController::class, 'pdf']
    )->name('invoices.pdf');
});

require __DIR__ . '/auth.php';
