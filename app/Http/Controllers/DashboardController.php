<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\Role;
use App\Models\DonorLogo;
use App\Models\FundRequest;
use App\Models\FundRequestItem;
use App\Models\ExpenditureSummary;
use App\Models\FinanceForm;
use App\Models\FinanceFormItem;
use Illuminate\Support\Facades\DB;
use App\Models\AllowanceForm;
use App\Models\AttendantList;

class DashboardController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role?->name, ['Admin', 'Finance'])) {
            abort(403); // or redirect()->route('fund-requests.index');
        }

        $users = User::count();

        $departments = Department::count();

        $roles = Role::count();

        $donors = DonorLogo::count();

        $fundRequests = FundRequest::count();

        $expenditureSummaries = ExpenditureSummary::count();

        // $financeForms = FinanceForm::count();

        $attendateList = AttendantList::count();

        $allowance = AllowanceForm::count();


        return view('dashboard.index', compact(

            'users',
            'departments',
            'roles',
            'donors',
            'fundRequests',
            'expenditureSummaries',
            // 'financeForms',
            'attendateList',
            'allowance',
        ));
    }
}
