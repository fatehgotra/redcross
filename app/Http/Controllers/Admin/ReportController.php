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
    public function hoursView(Request $request)
    {
        $aname = '';
        if (!is_null($request->start)) {

            $users     = CommunityAttendence::with('user')->where('date', '=', Carbon::parse($request->start)->format('d-m-Y'))->get();
            $campUsers = CampaignAttendance::with('user')->where('date', '=', Carbon::parse($request->start)->format('d-m-Y'))->get();

        } else if (!is_null($request->event)) {

            if (!is_null($request->type) && $request->type == 'community') {
                $users     = CommunityAttendence::with('user')->where('activity_id', '=', $request->event)->get();
                $aname     = CommunityActivity::find( $request->event )->name;
                $campUsers = [];
            } else {
                $users = [];
                $campUsers = CampaignAttendance::with('user')->where('campaign_id', '=', $request->event)->get();
                $aname     = Campaign::find( $request->event )->title;
            }


        } else {

            $users     = CommunityAttendence::with('user')->get();
            $campUsers = CampaignAttendance::with('user')->get();
        }

        $campaigns = Campaign::all();
        $community = CommunityActivity::where('status', 'Approved')->get();
        $cam = [];
        $com = [];

        if (count($campaigns) > 0) {
            foreach ($campaigns as $camp) {
                $cam[] = [
                    'id'    => $camp->id,
                    'title' => $camp->title,
                    'type'  => 'campaign',
                    'start' => $camp->starts_at,
                    'end'   => $camp->ends_at
                ];
            }
        }

        if (count($community) > 0) {
            foreach ($community as $cm) {
                $com[] = [
                    'id'    => $cm->id,
                    'title' => $cm->name,
                    'type'  => 'community',
                    'start' => $cm->starts_at,
                    'end'   => $cm->ends_at
                ];
            }
        }

        $events = (array_merge($cam, $com));


        return view('admin.report.add-hours', compact('users', 'events','campUsers','aname'));
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
        $hours = CommunityAttendence::with('activity')->where('email', $email->email)->orderBy('date', 'ASC')->get();
        $campaign = CampaignAttendance::with('activity')->where('user_id', $id)->orderBy('date', 'ASC')->get();

        $_hour = [];
        $camp = [];

        foreach ($hours as $hour) {
            $_hour[] = [
                'Activity'   => $hour->activity->name,
                'date'       => $hour->date,
                'start_time' => $hour->starts_at,
                'end_time'   => $hour->ends_at,
            ];
        }

        if (count($campaign) > 0) {

            foreach ($campaign as $ca) {
                $camp[] = [

                    'Activity'   => $ca->activity->title,
                    'date'       => $ca->date,
                    'start_time' => $ca->starts_at,
                    'end_time'   => $ca->ends_at,
                ];
            }
        }
        $users = array_merge($_hour, $camp);

        $output = Excel::download(new ExportHours($users), 'report-hours.xlsx');

        return $output;
    }
}
