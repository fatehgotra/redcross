<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LodgementInformation;
use App\Models\ServiceInterest;
use App\Models\Skill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $month_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        $month_user_chart = new LaravelChart($month_options);

        $volunteer_status_data = [
            'Active'   => User::whereIn('role', ['volunteer', 'both'])->whereHas('rewards')->orWhere('expiry_date', '>=', Carbon::now())->count(),
            'Inactive' =>  User::whereIn('role', ['volunteer', 'both'])->whereDoesntHave('rewards')->orWhere('expiry_date', '<=', Carbon::now())->count(),
            'Approved' =>  User::whereIn('role', ['volunteer', 'both'])->where('status', 'approve')->count(),
            'Pending'  =>  User::whereIn('role', ['volunteer', 'both'])->where('status', 'pending')->count(),
            'Declined' =>  User::whereIn('role', ['volunteer', 'both'])->where('status', 'decline')->count(),
        ];

        $members_status_data = [
            'Active'   =>  User::whereIn('role', ['member', 'both'])->whereHas('rewards')->orWhere('expiry_date', '>=', Carbon::now())->count(),
            'Inactive' =>  User::whereIn('role', ['member', 'both'])->whereDoesntHave('rewards')->orWhere('expiry_date', '<=', Carbon::now())->count(),
            'Approved' =>  User::whereIn('role', ['member', 'both'])->where('status', 'approve')->count(),
            'Pending'  =>  User::whereIn('role', ['member', 'both'])->where('status', 'pending')->count(),
            'Declined' =>  User::whereIn('role', ['member', 'both'])->where('status', 'decline')->count(),
        ];

        $volunteer_branch = User::select('branch', DB::raw('COUNT(*) as Users'))->whereIn('role', ['volunteer', 'both'])->groupBy('branch')->get();
        $member_branch = User::select('branch', DB::raw('COUNT(*) as Users'))->whereIn('role', ['member', 'both'])->groupBy('branch')->get();

        $volunteer_branch = $volunteer_branch->toArray();
        $member_branch = $member_branch->toArray();

        $volunteer_expertise_chart = ServiceInterest::with('user');
        $volunteer_expertise_chart = $volunteer_expertise_chart->withWhereHas('user', function ($q) {
            $q->whereIn('role', ['volunteer', 'both']);
        })->get()->groupBy('other_skills');
        $volunteer_expertise_chart = $volunteer_expertise_chart->toArray();

        $member_expertise_chart = ServiceInterest::with('user');
        $member_expertise_chart = $member_expertise_chart->withWhereHas('user', function ($q) {
            $q->whereIn('role', ['member', 'both']);
        })->get()->groupBy('other_skills');
        $member_expertise_chart = $member_expertise_chart->toArray();
        
        $male = User::with('personalInformation');
        $male = $male->withWhereHas('personalInformation', function ($q) {
                        $q->Where('sex' ,'male');
        })->count();

        $female = User::with('personalInformation');
        $female = $female->withWhereHas('personalInformation', function ($q) {
                        $q->Where('sex' ,'female');
        })->count();

        $non = User::with('personalInformation');
        $non = $non->withWhereHas('personalInformation', function ($q) {
                        $q->Where('sex' ,'Non-Binary');
        })->count();
 
        return view('admin.dashboard.dashboard', compact('month_user_chart', 'volunteer_status_data', 'members_status_data', 'volunteer_branch', 'member_branch', 'volunteer_expertise_chart','member_expertise_chart','male','female','non'));
    }
}
