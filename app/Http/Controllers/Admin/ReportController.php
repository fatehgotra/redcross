<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportHours;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\ReportUser;
use App\Imports\AddHours;
use App\Models\userHours;
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
                'member'     =>  $users->where('role', '=', 'member'),
            };

            $users = $users->get();

            $output = Excel::download(new ReportUser($users), 'report.xlsx');

            return $output;

            //return response()->json(['users' => $users]);
        } else if ($values == "" && $cndn != "na") {

            $users = match ($cndn) {
                'pending'        => ($type == 'all') ? $users->where('status', '=', 'pending') : (($type == 'volunteer') ? $users->where('role', '=', 'volunteer')->where('status', '=', 'pending') : $users->where('role', '=', 'member')->where('status', '=', 'pending')),
                'approved'       => ($type == 'all') ? $users->where('status', '=', 'approve') : (($type == 'volunteer') ? $users->where('role', '=', 'volunteer')->where('status', '=', 'approve') : $users->where('role', '=', 'member')->where('status', '=', 'approve')),
                'declined'       => ($type == 'all') ? $users->where('status', '=', 'decline') : (($type == 'volunteer') ? $users->where('role', '=', 'volunteer')->where('status', '=', 'decline') : $users->where('role', '=', 'member')->where('status', '=', 'decline')),
                'active'         => ($type == 'all') ? $users->whereHas('rewards')->orwhereDate('expiry_date', '>=', Carbon::now()) : (($type == 'volunteer')  ? $users->where('role', '=', 'volunteer')->whereHas('rewards')->orwhereDate('expiry_date', '>=', Carbon::now()) : $users->where('role', '=', 'member')->whereHas('rewards')->orwhereDate('expiry_date', '>=', Carbon::now())),
                'inactive'       => ($type == 'all') ? $users->whereDoesntHave('rewards')->orwhereDate('expiry_date', '<', Carbon::now()) : (($type == 'volunteer') ? $users->where('role', '=', 'volunteer')->whereDoesntHave('rewards')->orwhereDate('expiry_date', '>=', Carbon::now()) : $users->where('role', '=', 'member')->whereDoesntHave('rewards')->orwhereDate('expiry_date', '<', Carbon::now())),
            };

            $users = $users->get();

            $output = Excel::download(new ReportUser($users), 'report.xlsx');

            return $output;
        } else {

            $ev = explode(',', $values);

            $users = match ($type) {
                'all'        =>  $users = $users,
                'volunteer'  =>  $users->where('role', '=', 'volunteer'),
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
    public function hoursView()
    {

        return view('admin.report.add-hours');
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
        $email = User::find($id);
        $hours = userHours::where('email', $email->email)->orderBy('date','ASC')->get();

        $users = [];
        foreach ($hours as $hour) {
            $users[] = [
                'date' => $hour->date,
                'start_time' => $hour->start_time,
                'end_time' => $hour->end_time,
            ];
        }
        $output = Excel::download(new ExportHours($users), 'report-hours.xlsx');

        return $output;
    }
}
