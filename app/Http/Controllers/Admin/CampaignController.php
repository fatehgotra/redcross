<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\CampaignAttendance;
use App\Models\CampaignUser;
use App\Models\CommunityActivity;
use App\Models\CommunityAttendees;
use App\Models\CommunityDocs;
use App\Models\Flag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campaigns = Campaign::orderBy('id', 'desc')->get();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'starts_at'     => 'required',
            'ends_at'       => 'required',
            'entry_closed'  => 'required'
        ]);

        Campaign::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'starts_at'     => $request->starts_at,
            'ends_at'       => $request->ends_at,
            'entry_closed'  => $request->entry_closed
        ]);

        return redirect()->route('admin.campaigns.index')->with('sucess', 'Campaign created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $campaign = Campaign::find($id);
        $user_ids = CampaignUser::where('campaign_id', $id)->pluck('user_id')->toArray();
        $users    = User::whereIn('id', $user_ids)->get();
        $present_users = CampaignAttendance::where('date', Carbon::now()->format('Y-m-d'))->where('campaign_id', $id)->pluck('user_id')->toArray();
        return view('admin.campaigns.attendance', compact('campaign', 'users', 'present_users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $campaign = Campaign::find($id);
        return view('admin.campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'starts_at'     => 'required',
            'ends_at'       => 'required',
            'entry_closed'  => 'required'
        ]);

        Campaign::find($id)->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'starts_at'     => $request->starts_at,
            'ends_at'       => $request->ends_at,
            'entry_closed'  => $request->entry_closed
        ]);

        return redirect()->route('admin.campaigns.index')->with('sucess', 'Campaign deleted successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Campaign::find($id)->delete();
        return redirect()->route('admin.campaigns.index')->with('sucess', 'Campaign deleted successfully!');
    }

    public function markAttendance(Request $request, $id)
    {

        CampaignAttendance::where('date', Carbon::now()->format('Y-m-d'))->where('campaign_id', $id)->delete();
        if (!empty($request->attendance) && is_array($request->attendance)) {
            foreach ($request->attendance as $key => $attendance) {
                CampaignAttendance::create([
                    'date' => Carbon::now()->format('Y-m-d'),
                    'user_id' => $attendance,
                    'campaign_id' => $id
                ]);
            }
        }
        return redirect()->back()->with('sucess', 'Attendance updated successfully!');
    }

    public function campaginUserAdd(Request $request)
    {

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'branch'    => $request->branch,
        ]);

        CampaignUser::create([
            'user_id' => $user->id,
            'campaign_id' => $request->campagin
        ]);

        return redirect()->back()->with('success', 'User added to this activity successfully!');
    }

    public function AddFlag(Request $request)
    {

        Flag::create([
            'campaign_id' => $request->campaign_id,
            'user_id'     => $request->user_id,
            'reason'      => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Flag added to this user');
    }

    /******Community activity******/
    public function community()
    {

        if (Auth::guard('admin')->user()->hasRole('division-manager')) {

            $activities = CommunityActivity::where('submit_to', '=', Auth::guard('admin')->id())->get();
        } else {

            $activities = CommunityActivity::where('submit_by', '=', Auth::guard('admin')->id())->orWhere('status', 'Approved')->get();
        }

        //dd(Auth::guard('admin')->id());

        return view('admin.campaigns.community.index', compact('activities'));
    }

    public function communityActivity()
    {

        $admins = Admin::where('id', '!=', 1);

        $admin = $admins->whereHas('roles', function ($q) {
            $q->where(function ($q) {

                $q->where('name', 'division-manager');
            });
        });

        $admins = $admins->get();

        return view('admin.campaigns.community.add', compact('admins'));
    }

    public function communityStore(Request $request)
    {

        $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx', 'xlsx'];
        $docrestrict = ['jpg', 'png', 'jpeg'];
        $imgrestrict = ['pdf', 'docx', 'xlxs'];

        if (isset($request->image)) {
            foreach ($request->image as $image) {

                $file = $image['file'];
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                $check2 = in_array($extension, $imgrestrict);

                if (!$check) {

                    return redirect()->back()->with('error', "Image upload failed only  jpeg, jpg , png are allowed.");
                } else if ($check2) {

                    return redirect()->back()->with('error', 'Document in image upload section is not allowed.');
                }
            }
        }

        if (isset($request->doc)) {
            foreach ($request->doc as $doc) {

                $file = $doc['file'];
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                $check2 = in_array($extension, $docrestrict);

                if (!$check) {

                    return redirect()->back()->with('error', "Document upload failed only pdf , docx , xlsx are allowed.");
                } else if ($check2) {

                    return redirect()->back()->with('error', 'Images in document upload section is not allowed.');
                }
            }
        }

        $community = CommunityActivity::create([

            'name'      => $request->name,
            'breif'     => $request->breif,
            'starts_at' => $request->starts_at,
            'ends_at'   => $request->ends_at,
            'submit_by' => Auth::guard('admin')->id(),
            'submit_to' => $request->submit_to[0],

        ]);

        if (isset($request->attendees)) {
            foreach ($request->attendees as $at) {

                CommunityAttendees::create([
                    'community_id' => $community->id,
                    'attendee_id'  => $at,
                ]);
            }
        }



        if (isset($request->image)) {
            foreach ($request->image as $image) {

                $file = $image['file'];
                $filename = $file->getClientOriginalName();
                $name     = $filename . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/community/', $name, 'public');

                CommunityDocs::create([
                    'community_id' => $community->id,
                    'type'         => 'image',
                    'doc'          => $name,
                ]);
            }
        }

        if (isset($request->doc)) {
            foreach ($request->doc as $doc) {


                $file = $doc['file'];
                $filename = $file->getClientOriginalName();
                $name     = $filename . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('uploads/community/', $name, 'public');

                CommunityDocs::create([
                    'community_id' => $community->id,
                    'type'         => 'doc',
                    'doc'          => $name,
                ]);
            }
        }


        return redirect()->back()->with('success', 'Community Activity submitted successsfully!');
    }

    public function viewActivity($id)
    {
        $check =  CommunityActivity::where('submit_to', Auth::guard('admin')->id())->where('id', $id)->orWhere('status', 'Approved')->get();

        if (count($check)  == 0) {

            return redirect()->back();
        }

        $activity = CommunityActivity::with('attendees', 'attendees.user', 'submitBy', 'submitTo', 'docs')->where('id', $id)->get()->first();

        return view('admin.campaigns.community.view', compact('activity'));
    }

    public function approve($id)
    {
        CommunityActivity::where('id', $id)->update([
            'status' => 'Approved'
        ]);

        return redirect()->back()->with('success', 'Activity approved successfully.');
    }
}
