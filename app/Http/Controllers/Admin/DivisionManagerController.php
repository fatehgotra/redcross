<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DivisionManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DivisionManagerController extends Controller
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
        $users            = DivisionManager::orderBy('id', 'desc')->get();
        return view('admin.user-management.division-manager.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user-management.division-manager.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:division_managers'],
            'password'              => ['required', 'string', 'min:6'],
            'phone'                 => ['required', 'max:255']
        ];

        $messages = [
            'name.required'                         => 'Please enter division manager name.',
            'email.required'                        => 'Please enter division manager email address.',
            'password.required'                     => 'Please choose division manager password.',
            'phone.required'                        => 'Please enter phone or mobile number.',
        ];

        $this->validate($request, $rules, $messages);

        $user                   = DivisionManager::create([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
            'password'              => Hash::make($request->password)
        ]);

        return redirect()->route('admin.division-manager.index')->with('success', 'Division manager added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user            = DivisionManager::find($id);
        return view('admin.user-management.division-manager.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user                   = DivisionManager::find($id);
        return view('admin.user-management.division-manager.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:division_managers,email,' . $id],
            'phone'                 => ['required', 'max:255']           
        ];

        $messages = [
            'name.required'                         => 'Please enter division manager name.',
            'email.required'                        => 'Please enter division manager email address.',
            'phone.required'                        => 'Please enter phone or mobile number.'
        ];

        $this->validate($request, $rules, $messages);

        $user                   = DivisionManager::find($id);
        $user->name             = $request->name;
        $user->phone            = $request->phone;
        $user->email            = $request->email;
        if (isset($request->password)) {
            $user->password     = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('admin.division-manager.index')->with('success', 'Division manager updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DivisionManager::find($id)->delete();
        return redirect()->route('admin.division-manager.index')->with('success', 'Division manager deleted successfully!');
    }      

    public function resetPassword(Request $request){
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed']
        ]);
        DivisionManager::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
        return redirect()->route('admin.division-manager.index')->with('success', 'Division manager password has been reset successfully!');
    }
}
