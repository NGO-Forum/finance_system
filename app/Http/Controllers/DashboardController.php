<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use App\Models\DonorLogo;

use App\Models\FundRequest;
use App\Models\PurchaseRequest;
use App\Models\ExpenditureSummary;
use App\Models\FinanceForm;
use App\Models\AllowanceForm;
use App\Models\AttendantList;
use App\Models\DsaClaim;
use App\Models\VerbalQuote;
use App\Models\QuotationAnalysis;
use App\Models\PurchaseOrder;
use App\Models\GoodsReceivedNote;
use App\Models\Invoice;

class DashboardController extends Controller
{
    /**
     * Dashboard
     *
     * Admin + Finance:
     *     resources/views/dashboard/index.blade.php
     *
     * Staff + Manager + ED + other roles:
     *     resources/views/dashboard/user.blade.php
     */
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | ADMIN + FINANCE DASHBOARD
        |--------------------------------------------------------------------------
        */

        if (in_array($user->role?->name, ['Admin', 'Finance'])) {

            // =========================================================
            // MASTER DATA
            // =========================================================

            $users = User::count();

            $departments = Department::count();

            $roles = Role::count();

            $donors = DonorLogo::count();


            // =========================================================
            // FINANCE FORMS
            // =========================================================

            // FM02-01 Finance Form
            $financeForms = FinanceForm::count();

            // FM02-02 Concept Note
            $fundRequests = FundRequest::count();

            // FM02-03 Expenditure Summary
            $expenditureSummaries = ExpenditureSummary::count();

            // FM02-04 Purchase Request
            $purchaseRequests = PurchaseRequest::count();

            // FM02-05 Attendant List
            $attendateList = AttendantList::count();

            // FM02-06 DSA Claim
            $dsaClaims = DsaClaim::count();

            // FM02-07 Allowance
            $allowance = AllowanceForm::count();

            // FM02-09 Verbal Quote
            $verbalQuotes = VerbalQuote::count();

            // FM02-10 Quotation Analysis
            $quotationAnalyses = QuotationAnalysis::count();

            // FM02-11 Purchase Order
            $purchaseOrders = PurchaseOrder::count();

            // FM02-12 Goods Received Note
            $serviceReceivedNotes = GoodsReceivedNote::count();

            // FM02-14 Invoice
            $invoices = Invoice::count();


            // =========================================================
            // ADMIN / FINANCE VIEW
            // =========================================================

            return view('dashboard.index', compact(

                // Master Data
                'users',
                'departments',
                'roles',
                'donors',

                // Finance Forms
                'financeForms',
                'fundRequests',
                'expenditureSummaries',
                'purchaseRequests',
                'attendateList',
                'dsaClaims',
                'allowance',
                'verbalQuotes',
                'quotationAnalyses',
                'purchaseOrders',
                'serviceReceivedNotes',
                'invoices',
            ));
        }


        /*
        |--------------------------------------------------------------------------
        | ALL OTHER ROLES
        |--------------------------------------------------------------------------
        |
        | Staff
        | Manager
        | ED
        | Other roles
        |
        */

        return $this->dashboardUser();
    }


    /**
     * User Dashboard
     *
     * Shows the logged-in user's own forms.
     */
    public function dashboardUser()
    {
        $user = auth()->user();


        // FM02-02 Concept Note
        $fundRequests = FundRequest::where(
            'user_id',
            $user->id
        )->count();


        // FM02-04 Purchase Request
        $purchaseRequests = PurchaseRequest::where(
            'prepared_by',
            $user->id
        )->count();


        // FM02-03 Expenditure Summary
        $expenditureSummaries = ExpenditureSummary::where(
            'user_id',
            $user->id
        )->count();


        // FM02-07 Allowance Form
        $allowance = AllowanceForm::where(
            'created_by',
            $user->id
        )->count();


        // FM02-05 Attendant List
        $attendateList = AttendantList::where(
            'created_by',
            $user->id
        )->count();


        // FM02-09 Verbal Quote
        $verbalQuotes = VerbalQuote::where(
            'prepared_by',
            $user->id
        )->count();


        // FM02-10 Quotation Analysis
        $quotationAnalyses = QuotationAnalysis::where(
            'created_by',
            $user->id
        )->count();


        // Pending
        $purchaseRequestsPending = PurchaseRequest::where(
            'prepared_by',
            $user->id
        )
            ->whereIn('status', [
                'Pending Manager Approval',
                'Pending ED Approval',
                'Pending Finance Approval',
            ])
            ->count();


        // Approved
        $purchaseRequestsApproved = PurchaseRequest::where(
            'prepared_by',
            $user->id
        )
            ->where('status', 'Approved')
            ->count();


        // Rejected
        $purchaseRequestsRejected = PurchaseRequest::where(
            'prepared_by',
            $user->id
        )
            ->where('status', 'Rejected')
            ->count();


        $recentPurchaseRequests = PurchaseRequest::where(
            'prepared_by',
            $user->id
        )
            ->latest()
            ->take(5)
            ->get();



        return view('dashboard.user', compact(

            'fundRequests',

            'purchaseRequests',

            'expenditureSummaries',

            'allowance',

            'attendateList',

            'verbalQuotes',

            'quotationAnalyses',

            'purchaseRequestsPending',

            'purchaseRequestsApproved',

            'purchaseRequestsRejected',

            'recentPurchaseRequests',

        ));
    }
}
