<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
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
        $users            = Admin::orderBy('id', 'desc')->get();
        return view('admin.user-management.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user-management.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password'              => ['required', 'string', 'min:6'],
            'phone'                 => ['required', 'max:255']
        ];

        $messages = [
            'name.required'                         => 'Please enter admin name.',
            'email.required'                        => 'Please enter admin email address.',
            'password.required'                     => 'Please choose admin password.',
            'phone.required'                        => 'Please enter phone or mobile number.',
        ];

        $this->validate($request, $rules, $messages);

        $user                   = Admin::create([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
            'password'              => Hash::make($request->password)
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user            = Admin::find($id);
        return view('admin.user-management.admin.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user                   = Admin::find($id);
        return view('admin.user-management.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $id],
            'phone'                 => ['required', 'max:255']           
        ];

        $messages = [
            'name.required'                         => 'Please enter admin name.',
            'email.required'                        => 'Please enter admin email address.',
            'phone.required'                        => 'Please enter phone or mobile number.'           
        ];

        $this->validate($request, $rules, $messages);

        $user                   = Admin::find($id);
        $user->name             = $request->name;
        $user->phone            = $request->phone;
        $user->email            = $request->email;
        if (isset($request->password)) {
            $user->password     = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::find($id)->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully!');
    }      

    public function resetPassword(Request $request){
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        Admin::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->route('admin.admins.index')->with('success', 'Admin password has been reset successfully!');
    }
}
