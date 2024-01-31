<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\AddReceipt;
use App\Models\AdminSettings;
use App\Models\Check;
use App\Models\Consent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AdminSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function siteSetting()
    {

        return view('admin.settings.site');
    }

    public function saveSetting(Request $request)
    {

        foreach ($request->except('_token') as $key => $part) {

            $this->validate($request, [
                $key => 'required',
            ], ['required' => 'This field can\'t be empty']);

            AdminSettings::updateOrCreate(

                [
                    'setting_key' => $key
                ],
                [

                    'setting_key' => $key,
                    'setting_value' => $part,
                ]
            );

            return redirect()->back()->with('success', 'Settings updated successfully!');
        }
    }

    public function receiptUpload()
    {
        return view('admin.upload-receipt');
    }

    public function addReceipt(Request $request){

        if ($request->hasFile('receipts')) {

            Excel::import(new AddReceipt, $request->file('receipts')->store('temp'));
            return redirect()->back()->with('success', 'Receipt(s) added successfully!');
        }
        return redirect()->back()->with('error', 'Something went wrong.');
    }

    public function uploadStats(Request $request){
        //  $id = $request->uid;
        //  if( !is_null($request->statutory_declaration_attached) ){
        //     Consent::where('user_id',$id)->update(['statutory_declaration_attached'=> $request->statutory_declaration_attached]);
        //  }
         
         $check_data                                             = array();
         $check_data['statutory_declaration_attached']           = $request->statutory_declaration_attached;
         if ($request->hasfile('statutory_declaration')) {
             $statutory_declaration = $request->file('statutory_declaration');
             $sdname     = time() . '.' . $statutory_declaration->getClientOriginalExtension();
             $statutory_declaration->storeAs('uploads/users/' .$request->uid . '/checks', $sdname, 'public');
             $check_data['statutory_declaration']                = $sdname;
         }
         $check_data['code_of_conduct_attached']                 = $request->code_of_conduct_attached;
         if ($request->hasfile('code_of_conduct')) {
             $code_of_conduct = $request->file('code_of_conduct');
             $cocname     = time() . '.' . $code_of_conduct->getClientOriginalExtension();
             $code_of_conduct->storeAs('uploads/users/' .$request->uid . '/checks', $cocname, 'public');
             $check_data['code_of_conduct']                      = $cocname;
         }
         $check_data['signed_child_protection_policy_attached']  = $request->signed_child_protection_policy_attached;
         if ($request->hasfile('signed_child_protection_policy')) {
             $signed_child_protection_policy = $request->file('signed_child_protection_policy');
             $scppname     = time() . '.' . $signed_child_protection_policy->getClientOriginalExtension();
             $signed_child_protection_policy->storeAs('uploads/users/' .$request->uid . '/checks', $scppname, 'public');
             $check_data['signed_child_protection_policy']       = $scppname;
         }
         $check_data['professional_volunteer']                   = $request->professional_volunteer;
         if ($request->hasfile('professional_volunteer_attachment')) {
             $professional_volunteer_attachment = $request->file('professional_volunteer_attachment');
             $pvaname     = time() . '.' . $professional_volunteer_attachment->getClientOriginalExtension();
             $professional_volunteer_attachment->storeAs('uploads/users/' .$request->uid . '/checks', $pvaname, 'public');
             $check_data['professional_volunteer_attachment']    = $pvaname;
         }
        // $check_data['base_location']                            = $request->base_location;
         Check::updateOrCreate(['user_id' => $request->uid], $check_data);
         
         return redirect()->back()->with('success','Updated successfully');
         
        //dd($request->all());
    }
}
