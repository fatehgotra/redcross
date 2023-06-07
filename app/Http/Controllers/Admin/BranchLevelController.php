<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BranchLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BranchLevelController extends Controller
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
        $users            = BranchLevel::orderBy('id', 'desc')->get();
        return view('admin.user-management.branch-level.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user-management.branch-level.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:branch_levels'],
            'password'              => ['required', 'string', 'min:6'],
            'phone'                 => ['required', 'max:255']
        ];

        $messages = [
            'name.required'                         => 'Please enter branch level name.',
            'email.required'                        => 'Please enter branch level email address.',
            'password.required'                     => 'Please choose branch level password.',
            'phone.required'                        => 'Please enter phone or mobile number.',
        ];

        $this->validate($request, $rules, $messages);

        $user                   = BranchLevel::create([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
            'password'              => Hash::make($request->password)
        ]);

        return redirect()->route('admin.branch-level.index')->with('success', 'Branch Level added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user            = BranchLevel::find($id);
        return view('admin.user-management.branch-level.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user                   = BranchLevel::find($id);
        return view('admin.user-management.branch-level.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:branch_levels,email,' . $id],
            'phone'                 => ['required', 'max:255']           
        ];

        $messages = [
            'name.required'                         => 'Please enter branch level name.',
            'email.required'                        => 'Please enter branch level email address.',
            'phone.required'                        => 'Please enter phone or mobile number.'           
        ];

        $this->validate($request, $rules, $messages);

        $user                   = BranchLevel::find($id);
        $user->name             = $request->name;
        $user->phone            = $request->phone;
        $user->email            = $request->email;
        if (isset($request->password)) {
            $user->password     = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('admin.branch-level.index')->with('success', 'Branch Level updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BranchLevel::find($id)->delete();
        return redirect()->route('admin.branch-level.index')->with('success', 'Branch Level deleted successfully!');
    }      

    public function resetPassword(Request $request){
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        BranchLevel::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->route('admin.branch-level.index')->with('success', 'Branch Level password has been reset successfully!');
    }
}
