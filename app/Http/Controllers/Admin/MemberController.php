<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApprovalHistory;
use App\Models\Country;
use App\Models\User;
use App\Notifications\ApprovalNotification;
use App\Notifications\DeclineNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter_status    = $request->status;
        $filter_active    = $request->active;
        $branch           = Auth::guard('admin')->user()->branch;
        $users            = User::with('lodgementInformation');
        if($filter_status){
            $users        = $users->where('status', $filter_status);
        }
        if($filter_active == 'yes'){
            $users        = $users->where('status','approve')->whereDate('expiry_date','>=',Carbon::now()->format('Y-m-d') );
        }

        if($filter_active == 'no'){
            $users        = $users->where('status','approve')->whereDate('expiry_date','<',Carbon::now()->format('Y-m-d') );
        }
        if (Auth::guard('admin')->user()->hasRole('admin')) {
            $users        = $users->whereIn('role', ['member', 'both'])->orderBy('id', 'desc')->get();
        } else {
            $users->whereHas('lodgementInformation', function ($q) use ($branch) {
                $q->where(function ($q) use ($branch) {
                    $q->whereIn('registration_location_type', $branch);
                });
            });

            $users        = $users->whereIn('role', ['member', 'both'])->orderBy('id', 'desc')->get();
        }

        return view('admin.members.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries  = Country::get();
        return view('admin.users.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'string', 'min:6'],
            'phone'                 => ['required', 'max:255'],
            'country'               => ['required', 'string', 'max:255']
        ];

        $messages = [
            'name.required'                         => 'Please enter user name.',
            'email.required'                        => 'Please enter user email address.',
            'password.required'                     => 'Please choose user password.',
            'phone.required'                        => 'Please enter phone or mobile number.',
            'country.required'                      => 'Please choose country.'
        ];

        $this->validate($request, $rules, $messages);

        $user                   = User::create([
            'name'                  => $request->name,
            'surname'               => $request->surname,
            'email'                 => $request->email,
            'phone'                => $request->phone,
            'country'               => $request->country,
            'password'              => Hash::make($request->password)
        ]);

        return redirect()->route('admin.members.index')->with('success', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user            = User::find($id);
        $countries       = Country::get();
        return view('admin.members.view', compact('user', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user                   = User::find($id);
        $countries              = Country::get();
        return view('admin.members.edit', compact('user', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'password'              => ['required', 'string', 'min:6'],
            'phone'                 => ['required', 'max:255'],
            'country'               => ['required', 'string', 'max:255']
        ];

        $messages = [
            'name.required'                         => 'Please enter user name.',
            'email.required'                        => 'Please enter user email address.',
            'password.required'                     => 'Please choose user password.',
            'phone.required'                        => 'Please enter phone or mobile number.',
            'country.required'                      => 'Please choose country.'
        ];

        $this->validate($request, $rules, $messages);

        $user                   = User::find($id);
        $user->name             = $request->name;
        $user->phone            = $request->phone;
        $user->email            = $request->email;
        if (isset($request->password)) {
            $user->password     = Hash::make($request->password);
        }
        $user->country          = $request->country;
        $user->save();
        return redirect()->route('admin.members.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.members.index')->with('success', 'User deleted successfully!');
    }

    public function changeStatus(Request $request, $id)
    {
        $roles = Auth::guard('admin')->user()->getRoleNames()->toArray();

        if (in_array('hq', $roles)) {

            User::find($id)->update([
                'status'        => $request->status,
                'approved_by'   => 'HQ',
                'approver_id'   => Auth::guard('admin')->id(),
                'decline_reason' => $request->has('reason') ? $request->reason : null
            ]);

            ApprovalHistory::create([
                'user_id'       => $id,
                'status'        => $request->status,
                'approved_by'   => 'HQ',
                'approver_id'   => Auth::guard('admin')->id()
            ]);

            if ($request->status == 'approve') {
                $user = User::find($id);
                $user->notify(new ApprovalNotification('hq'));
                return redirect()->back()->with('success', 'Volunteer approved successfully!');
            } else {
                $user = User::find($id);
                $user->notify(new DeclineNotification('hq'));
                return redirect()->back()->with('success', 'Volunteer declined successfully!');
            }

        } elseif (in_array('division-manager', $roles)) {

            User::find($id)->update([
                'status'        => $request->status,
                'approved_by'   => 'HQ',
                'approver_id'   => Auth::guard('admin')->id(),
                'decline_reason' => $request->has('reason') ? $request->reason : null
            ]);

            ApprovalHistory::create([
                'user_id'       => $id,
                'status'        => $request->status,
                'approved_by'   => 'HQ',
                'approver_id'   => Auth::guard('admin')->id()
            ]);

            if ($request->status == 'approve') {
                $user = User::find($id);
                $user->notify(new ApprovalNotification('hq'));
                return redirect()->back()->with('success', 'Volunteer approved successfully!');
            } else {
                $user = User::find($id);
                $user->notify(new DeclineNotification('hq'));
                return redirect()->back()->with('success', 'Volunteer declined successfully!');
            }

        } elseif (in_array('branch-level', $roles)) {
            User::find($id)->update([
                'status'        => $request->status,
                'approved_by'   => 'HQ',
                'approver_id'   => Auth::guard('admin')->id(),
                'decline_reason' => $request->has('reason') ? $request->reason : null
            ]);

            ApprovalHistory::create([
                'user_id'       => $id,
                'status'        => $request->status,
                'approved_by'   => 'HQ',
                'approver_id'   => Auth::guard('admin')->id()
            ]);

            if ($request->status == 'approve') {
                $user = User::find($id);
                $user->notify(new ApprovalNotification('hq'));
                return redirect()->back()->with('success', 'Volunteer approved successfully!');
            } else {
                $user = User::find($id);
                $user->notify(new DeclineNotification('hq'));
                return redirect()->back()->with('success', 'Volunteer declined successfully!');
            }
        } else {
            abort(403);
        }
    }

    public function approvalHistory($id)
    {
        $approval_history   = ApprovalHistory::where('user_id', $id)->orderBy('id', 'desc')->get();
        $user               = User::find($id);
        return view('admin.members.approval-history', compact('approval_history', 'user'));
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->route('admin.members.index')->with('success', 'Volunteer password has been reset successfully!');
    }

    public function showExpiryForm($id){
        $user = User::find($id);
        return view('admin.members.expiry', compact('user'));
    }

    public function updateExpiry(Request $request, $id){
        $this->validate($request, [
            'expiry_date' => ['required']
        ]);
        $user = User::find($id)->update(['expiry_date' => $request->expiry_date]);
        return redirect()->route('admin.members.expiry', $id)->with('success', 'Membership expiry date updated successfully!');
    }
}
