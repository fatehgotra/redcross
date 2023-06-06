<?php

namespace App\Http\Controllers\BranchLevel;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class USerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:branch-level');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users            = User::orderBy('id', 'desc')->get();
        return view('branch-level.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries  = Country::get();
        return view('branch-level.users.create', compact('countries'));
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

        return redirect()->route('branch-level.suppliers.index')->with('success', 'User added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user            = User::find($id);
        $countries       = Country::get();
        return view('branch-level.users.view', compact('user', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user                   = User::find($id);
        $countries              = Country::get();
        return view('branch-level.users.edit', compact('user', 'countries'));
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
        return redirect()->route('branch-level.users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('branch-level.suppliers.index')->with('success', 'User deleted successfully!');
    }   

    public function changeStatus(Request $request, $id){

       
        User::find($id)->update(['status' => $request->status]);
        if($request->status == 'approve'){
            return redirect()->back()->with('success', 'Volunteer approved successfully!');
        }else{
            return redirect()->back()->with('success', 'Volunteer declined successfully!');
        }
    
    }

    public function resetPassword(Request $request){
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->route('branch-level.volunteers.index')->with('success', 'Volunteer password has been reset successfully!');
    }
}
