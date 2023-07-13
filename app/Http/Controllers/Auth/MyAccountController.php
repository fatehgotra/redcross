<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'approved']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $id                 = Auth::user()->id;
        $user               = User::find($id);
        $user->avatar       = isset($user->avatar) ? asset('storage/uploads/users/' . $id . '/' . $user->avatar) : URL::to('assets/images/users/avatar.png');
        return view('user.settings.my-account', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user          = User::find($id);

        $rules = [
            'firstname'                  => ['required', 'string', 'max:255'],
            'lastname'               => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],            
            'phone' => ['required', 'max:255'],            
        ];

        $messages = [
            'firstname.required'                         => 'Please enter Supplier name.',
            'lasyname.required'                      => 'Please enter Supplier surname.',
            'email.required'                        => 'Please enter email address.',
            'company_name.required'                 => 'Please enter Company name.',
            'mobile_contact_number.required'        => 'Please enter Company mobile contact number.',
            'company_address.required'              => 'Please enter Company address.',
            'city.required'                         => 'Please enter Company city.',
            'province.required'                     => 'Please enter Company province.',
            'postal_code.required'                  => 'Please enter Company postal code.',
            'country.required'                      => 'Please choose Company country.',
            'bank.required'                         => 'Please choose Bank.',
            'account_no.required'                   => 'Please enter Bank A/C number.',
            'proof_of_banking.required'             => 'Please upload Proof of banking.',
        ];

        
        $user->firstname    = $request->firstname;
        $user->lastname    = $request->lastname;
        $user->email   = $request->email;
        $user->phone   = $request->phone;

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/users/' . $id, $name, 'public');

            if (isset($user->avatar)) {

                $path   = 'public/uploads/users/' . $id . '/' . $user->avatar;

                Storage::delete($path);
            }

            $user->avatar = $name;
        }

        $user->save();
        

        return redirect()->route('my-account.edit', $user->id)->with('success', 'Account updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
