<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Country;
use App\Models\Credential;
use App\Models\UserBankDetail;
use App\Models\UserExhibitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'approved']);
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
        $exhibitor          = User::find($id);
        $countries          = Country::get();
        $banks              = Bank::get();
        $exhibitor->avatar  = isset($exhibitor->avatar) ? asset('storage/uploads/suppliers/' . $id . '/' . $exhibitor->avatar) : URL::to('assets/images/users/avatar.png');
        return view('exhibitor.settings.my-account', compact('exhibitor', 'countries', 'banks'));
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
        $exhibitor          = User::find($id);

        $rules = [
            'name'                  => ['required', 'string', 'max:255'],
            'surname'               => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'company_name'          => ['required', 'string', 'max:255'],
            'mobile_contact_number' => ['required', 'max:255'],
            'company_address'       => ['required', 'string', 'max:255'],
            'city'                  => ['required', 'string', 'max:255'],
            'province'              => ['required', 'string', 'max:255'],
            'postal_code'           => ['required', 'string', 'max:255'],
            'country'               => ['required', 'string', 'max:255'],
            'bank'                  => ['required', 'string', 'max:255'],
            'account_no'            => ['required', 'string', 'max:255'],
            'proof_of_banking'      => isset($exhibitor->bank->proof_of_banking) ? [] : ['required'],
        ];

        $messages = [
            'name.required'                         => 'Please enter Supplier name.',
            'surname.required'                      => 'Please enter Supplier surname.',
            'email.required'                        => 'Please enter Supplier email address.',
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

        
        $exhibitor->name    = $request->name;
        $exhibitor->email   = $request->email;

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/suppliers/' . $id, $name, 'public');

            if (isset($exhibitor->avatar)) {

                $path   = 'public/uploads/suppliers/' . $id . '/' . $exhibitor->avatar;

                Storage::delete($path);
            }

            $exhibitor->avatar = $name;
        }

        $exhibitor->save();

        UserExhibitor::updateOrCreate(
            [
                'user_id'               => $exhibitor->id,
            ],
            [

                'company_name'          => $request->company_name,
                'mobile_contact_number' => $request->mobile_contact_number,
                'company_address'       => $request->company_address,
                'city'                  => $request->city,
                'province'              => $request->province,
                'postal_code'           => $request->postal_code,
                'country'               => $request->country,
            ]
        );

        if ($request->hasfile('proof_of_banking')) {

            $file      = $request->file('proof_of_banking');

            $name       = $file->getClientOriginalName();

            $file->storeAs('uploads/suppliers/' . $id, $name, 'public');

            if (isset($exhibitor->bank->proof_of_banking)) {

                $path   = 'public/uploads/suppliers/' . $id . '/' . $exhibitor->bank->proof_of_banking;

                Storage::delete($path);
            }
        }

        UserBankDetail::updateOrCreate(
            [
                'user_id'               => $exhibitor->id,
            ],
            [
                'bank'                  => $request->bank,
                'account_no'            => $request->account_no,
                'proof_of_banking'      => $request->hasfile('proof_of_banking') ? $name : $exhibitor->bank->proof_of_banking,
            ]
        );
        $credentials = Credential::first();
        if(isset($exhibitor->vendhq_supplier_id)){
            Http::withToken($credentials->personal_access_token)->post('https://'.$credentials->domain_prefix.'.vendhq.com/api/supplier', [                
                'id'                        => $exhibitor->vendhq_supplier_id,
                'name'                      => $exhibitor->name . ' ' . $exhibitor->surname,
                'description'               => 'Created at: ' . $exhibitor->created_at,
                'contact'                   => [
                    'first_name'            => $exhibitor->name,
                    'last_name'             => $exhibitor->surname,
                    'company_name'          => $exhibitor->exhibitor->company_name ? $exhibitor->exhibitor->company_name : null,
                    'mobile'                => $exhibitor->exhibitor->mobile_contact_number ? $exhibitor->exhibitor->mobile_contact_number : null,
                    'email'                 => $exhibitor->email ? $exhibitor->email : null,
                    'physical_address1'     => $exhibitor->exhibitor->company_address ? $exhibitor->exhibitor->company_address : null,
                    'physical_suburb'       => $exhibitor->exhibitor->city ? $exhibitor->exhibitor->city : null,
                    'physical_city'         => $exhibitor->exhibitor->city ? $exhibitor->exhibitor->city : null,
                    'physical_state'        => $exhibitor->exhibitor->province ? $exhibitor->exhibitor->province : null,
                    'physical_postcode'     => $exhibitor->exhibitor->postal_code ? $exhibitor->exhibitor->postal_code : null,
                    'physical_country_id'   => $exhibitor->exhibitor->country ? $exhibitor->exhibitor->country : null,
                ],

            ]);
        }

        return redirect()->route('my-account.edit', $exhibitor->id)->with('success', 'Account updated successfully!');
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
