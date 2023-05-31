<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class VolunteerDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Tab 1
    public function lodgeInformationForm($id)
    {
        $user                   = User::find($id);
        $lodgement_information  = User::find($id)->lodgementInformation;
        return view('admin.users.volunteer-details.lodge-information', compact('user', 'lodgement_information'));
    }


    // Tab 2
    public function personalInformationForm($id)
    {
        $user                 = User::find($id);
        $personal_information = User::find($id)->personalInformation;
        return view('admin.users.volunteer-details.personal-information', compact('user', 'personal_information'));
    }


    // Tab 3
    public function contactInformationForm($id)
    {
        $user                = User::find($id);
        $contact_information = User::find($id)->contactInformation;
        return view('admin.users.volunteer-details.contact-information', compact('user', 'contact_information'));
    }

    // Tab 4

    public function identificationAndEmployementDetailsForm($id)
    {
        $user                   = User::find($id);
        $identification_details = User::find($id)->validNationalIdentification;
        $employment_details     = User::find($id)->employmentDetail;
        return view('admin.users.volunteer-details.identification-and-employement-details', compact('user', 'identification_details', 'employment_details'));
    }


    // Tab 5
    public function educationBackgroundForm($id)
    {
        $user                   = User::find($id);
        $education_background   = User::find($id)->educationBackgroud;
        $qualifications         = User::find($id)->qualifications;
        $skills                 = User::find($id)->skills;
        return view('admin.users.volunteer-details.education-background', compact('user', 'education_background', 'qualifications', 'skills'));
    }


    // Tab 6
    public function specialInformationForm($id)
    {
        $user                   = User::find($id);
        $special_information    = User::find($id)->specialInformation;
        $blood_information      = User::find($id)->bloodInformation;
        $volunteers             = User::find($id)->volunteers;
        return view('admin.users.volunteer-details.special-information', compact('user', 'special_information', 'blood_information', 'volunteers'));
    }


    // Tab 7
    public function serviceInterestForm($id)
    {
        $user               = User::find($id);
        $service_interest   = User::find($id)->serviceInterest;
        return view('admin.users.volunteer-details.service-interest', compact('user', 'service_interest'));
    }

    // Tab 8
    public function bankingInformationForm($id)
    {
        $user                           = User::find($id);
        $personal_banking_information   = User::find($id)->personalBankingInformation;
        $mobile_banking_information     = User::find($id)->mobileBankingInformation;
        return view('admin.users.volunteer-details.banking-information', compact('user', 'personal_banking_information', 'mobile_banking_information'));
    }

    // Tab 9
    public function consentsAndChecksForm($id)
    {
        $user       = User::find($id);
        $consents   = User::find($id)->consents;
        $checks     = User::find($id)->checks;
        $referees   = User::find($id)->referees;
        return view('admin.users.volunteer-details.consents-and-checks', compact('user', 'consents', 'checks', 'referees'));
    }


}
