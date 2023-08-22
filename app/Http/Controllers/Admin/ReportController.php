<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportHours;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\ReportUser;
use App\Imports\AddHours;
use App\Models\Campaign;
use App\Models\CampaignAttendance;
use App\Models\CommunityActivity;
use App\Models\CommunityAttendence;
use App\Models\UserHours;
use Excel;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function generateReport()
    {
        return view('admin.report.generate');
    }
    public function exportExcel(Request $request)
    {
        $type   = $request->type;
        $cndn   = $request->cndn;
        $values = $request->values;

        $users = User::with('lodgementInformation', 'skills', 'personalInformation');

        if ($cndn == 'na') {

            $users = match ($type) {
                'all'        =>  $users->where('role', '=', 'volunteer')->orWhere('role', '=', 'member')->orWhere('role', '=', 'both'),
                'volunteer'  =>  $users->where('role', '=', 'volunteer'),
                'volboth'    =>  $users->whereIn('role',['volunteer','both']),
                'memboth'    =>  $users->whereIn('role',['both','member']),
                'member'     =>  $users->where('role', '=', 'member'),
            };

            $users = $users->get();

            $output = Excel::download(new ReportUser($users), 'report.xlsx');

            return $output;

            //return response()->json(['users' => $users]);
        } else if ($values == "" && $cndn != "na") {

            $users = match ($cndn) {
                'pending'        => ($type == 'all') ? $users->where('status', '=', 'pending') : ( ($type == 'volunteer') ? $users->where('role', '=', 'volunteer')->where('status', '=', 'pending') : ( $type == 'volboth' ? $users->whereIn( 'role',['volunteer','both'] )->where('status','pending') : ( $type == 'memboth' ? $users->whereIn('role',['member','both'])->where('status','pending') : $users->where('role', '=', 'member')->where('status', '=', 'pending') ) ) ),
                'approved'       => ($type == 'all') ? $users->where('status', '=', 'approve') : ( ($type == 'volunteer') ? $users->where('role', '=', 'volunteer')->where('status', '=', 'approve') : ( $type == 'volboth' ? $users->whereIn( 'role',['volunteer','both'] )->where('status','approve') : ( $type == 'memboth' ? $users->whereIn('role',['member','both'])->where('status','approve') : $users->where('role', '=', 'member')->where('status', '=', 'approve') ) ) ),
                'declined'       => ($type == 'all') ? $users->where('status', '=', 'decline') : ( ($type == 'volunteer') ? $users->where('role', '=', 'volunteer')->where('status', '=', 'decline') : ( $type == 'volboth' ? $users->whereIn( 'role',['volunteer','both'] )->where('status','decline') : ( $type == 'memboth' ? $users->whereIn('role',['member','both'])->where('status','decline') : $users->where('role', '=', 'member')->where('status', '=', 'decline') ) ) ),
                'active'         => ($type == 'all') ? $users->whereHas('rewards')->orWhereHas('campagin')->orWhereHas('activities') : ( ($type == 'volunteer')  ? $users->whereHas('rewards')->orWhereHas('campagin')->orWhereHas('activities')->where('role', '=', 'volunteer') : ( ( $type == 'volboth' ? $users->whereHas('rewards')->orWhereHas('campagin')->orWhereHas('activities')->whereIn('role',['volunteer','both'])   : ( (  $type == 'memboth' ? $users->where('status','approve')->whereDate('expiry_date','>=',Carbon::now()->format('Y-m-d') )->whereIn('role',['member','both']) :  $users->where('status','approve')->whereDate('expiry_date','>=',Carbon::now()->format('Y-m-d') )->where('role', '=', 'member') ) ) ) ) ),
                'inactive'       => ($type == 'all') ? $users->where('status','approve')->whereDoesntHave('campagin')->whereDoesntHave('rewards')->whereDoesntHave('activities') : ( ($type == 'volunteer')  ? $users->where('status','approve')->whereDoesntHave('campagin')->whereDoesntHave('rewards')->whereDoesntHave('activities')->where('role', '=', 'volunteer') : ( ( $type == 'volboth' ? $users->where('status','approve')->whereDoesntHave('campagin')->whereDoesntHave('rewards')->whereDoesntHave('activities')->whereIn('role',['volunteer','both'])  : ( (  $type == 'memboth' ? $users->where('status','approve')->whereDate('expiry_date','<',Carbon::now()->format('Y-m-d') )->whereIn('role',['member','both']) :  $users->where('status','approve')->whereDate('expiry_date','<',Carbon::now()->format('Y-m-d') )->where('role', '=', 'member') ) ) ) ) ),
            };

            $users = $users->get();

            $output = Excel::download(new ReportUser($users), 'report.xlsx');

            return $output;
        } else {

            $ev = explode(',', $values);

            $users = match ($type) {
                'all'        =>  $users = $users,
                'volunteer'  =>  $users->where('role', '=', 'volunteer'),
                'volboth'    =>  $users->whereIn('role',['volunteer','both']),
                'memboth'    =>  $users->whereIn('role',['both','member']),
                'member'     =>  $users->where('role', '=', 'member'),
            };

            if ($cndn == 'location' || $cndn == 'branch') {

                $users = $users->WhereIn('branch', $ev);
            }

            if ($cndn == 'gender') {
                $users = $users->withWhereHas('personalInformation', function ($q) use ($ev) {

                    $q->WhereIn('sex', $ev);
                });
            }

            if ($cndn == 'expertise') {

                $users = $users->withWhereHas('ServiceInterest', function ($q) use ($ev) {

                    for ($i = 0; $i < count($ev); $i++) {
                        $q->orWhere('other_skills', 'like', '%' . $ev[$i] . '%');
                    }
                });
            }
            $users = $users->get();

            $output = Excel::download(new ReportUser($users), 'report.xlsx');

            return $output;
        }
    }
    public function hoursView(Request $request)
    {
        $aname = '';
        if (!is_null($request->start)) {

            $users     = UserHours::with('user')->where('date', '=', Carbon::parse($request->start)->format('d-m-Y'))->get();
          
        } else {

            $users     = UserHours::with('user')->get();
            
        }

        return view('admin.report.add-hours', compact('users'));
    }
    public function addHours(Request $request)
    {

        if ($request->hasFile('report')) {

            Excel::import(new AddHours, $request->file('report')->store('temp'));
            return redirect()->back()->with('success', 'Time report added successfully!');
        }
        return redirect()->back()->with('error', 'Something went wrong.');
    }
    public function exportHours(Request $request, $id)
    {
        $email = User::find($id)->email;
       
        $users = UserHours::where('email',$email);

        $output = Excel::download(new ExportHours($email), 'report-hours.xlsx');

        return $output;
    }
}
