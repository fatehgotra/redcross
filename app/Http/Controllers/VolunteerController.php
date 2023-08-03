<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VolunteerController extends Controller
{
    // Tab 1
    public function lodgeInformationForm()
    {
        return view('volunteer.lodge-information');
    }

    public function lodgeInformation(Request $request)
    {
        $rules = [
            'date_of_lodgement'                    => 'required',
            'registering_year'                     => 'required',
            'division'                             => 'required',
            'registration_location_type'           => 'required',
            'role'                                 => 'required',
        ];

        $messages = [
            'date_of_lodgement.required'           => 'Please enter Date of Lodgement',
            'registering_year.required'            => 'Please enter Registering Year.',
            'division.required'                    => 'Please select Division',
            'registration_location_type.required'  => 'Please select your nearest branch.',
            'role.required'                        => 'Please select role.',
        ];

        $this->validate($request, $rules, $messages);

        $data                                      = array();
        $data['date_of_lodgement']                 = $request->date_of_lodgement;
        $data['registering_year']                  = $request->registering_year;
        $data['division']                          = $request->division;
        $data['registration_location_type']        = $request->registration_location_type;
        $data['role']                              = $request->role;

        Session::put('lodgement-information', $data);

        return redirect()->route('personal-information.form')->with('success', 'Lodgement Information saved successfully');
    }

    // Tab 2
    public function personalInformationForm()
    {
        return view('volunteer.personal-information');
    }

    public function personalInformation(Request $request)
    {
        $rules = [
            'lastname'                              => 'required',
            'firstname'                             => 'required',
            'father_name'                           => 'required',
            'date_of_birth'                         => 'required',
            'sex'                                   => 'required',
            'citizenship'                           => 'required',
            'specify_citizenship'                   => $request->citizenship == 'Other' ? 'required' : '',
            'ethnic_background'                     => 'required|array|min:1',
            'specify_ethnic_background'             => is_array($request->ethnic_background) ? (in_array('Other', $request->ethnic_background) ? 'required' : '') : '',
            'marital_status'                        => 'required',
            // 'no_of_dependents'                      => 'required',
            // 'languages_spoken'                      => 'required|array|min:1',
            // 'specify_languages_spoken'              => is_array($request->languages_spoken) ? (in_array('Other Languages', $request->languages_spoken) ? 'required' : '') : '',
        ];

        $messages = [
            'lastname.required'                     => 'Please enter Lastname',
            'firstname.required'                    => 'Please enter Firstname.',
            'father_name.required'                  => 'Please enter Father\'s name',
            'date_of_birth.required'                => 'Please enter Date of Birth.',
            'sex.required'                          => 'Please select Sex.',
            'citizenship.required'                  => 'Please select Citizenship.',
            'specify_citizenship.required'          => 'Please specify Citizenship.',
            'ethnic_background.required'            => 'Please select Ethnic background.',
            'specify_ethnic_background.required'    => 'Please specify Ethnic background.',
            'marital_status.required'               => 'Please select Marital Status.',
            // 'no_of_dependents.required'             => 'Please enter No. of Dependents.',
            // 'languages_spoken.required'             => 'Please select Languages Spoken.',
            // 'specify_languages_spoken.required'     => 'Please specify Languages Spoken.',
        ];

        $this->validate($request, $rules, $messages);

        $data                                       = array();
        $data['lastname']                           = $request->lastname;
        $data['firstname']                          = $request->firstname;
        $data['other_names']                        = $request->other_names;
        $data['father_name']                        = $request->father_name;
        $data['date_of_birth']                      = $request->date_of_birth;
        $data['sex']                                = $request->sex;
        $data['citizenship']                        = $request->citizenship;
        $data['specify_citizenship']                = $request->specify_citizenship;
        $data['ethnic_background']                  = $request->ethnic_background;
        $data['specify_ethnic_background']          = $request->specify_ethnic_background;
        $data['marital_status']                     = $request->marital_status;
        // $data['no_of_dependents']                   = $request->no_of_dependents;
        // $data['languages_spoken']                   = $request->languages_spoken;
        // $data['specify_languages_spoken']           = $request->specify_languages_spoken;       

        Session::put('personal-information', $data);

        return redirect()->route('contact-information.form')->with('success', 'Personal Information saved successfully');
    }

    // Tab 3
    public function contactInformationForm()
    {
        return view('volunteer.contact-information');
    }

    public function contactInformation(Request $request)
    {
        $rules = [
            'resedential_address'               => 'required',
            'community_name'                    => 'required',
            'community_type'                    => 'required',
            'province'                          => 'required',
            'district'                          => 'required',
            'postal_address'                    => 'required',
            'email'                             => 'required',
            'landline_contact'                  => 'required',
            'primary_mobile_contact_number'     => 'required',
            // 'full_name_of_emergency_contact'    => 'required',
            // 'relationship'                      => 'required',
            // 'contact_number'                    => 'required',
        ];

        $messages = [
            'resedential_address.required'              => 'Please enter Resedential Address',
            'community_name.required'                   => 'Please enter Community Name.',
            'community_type.required'                   => 'Please enter Community Type',
            'province.required'                         => 'Please enter Province.',
            'district.required'                         => 'Please enter District / Tikina.',
            'postal_address.required'                   => 'Please enter Postal Address',
            'email.required'                            => 'Please enter Community Name.',
            'landline_contact.required'                 => 'Please enter Landline Contact',
            'primary_mobile_contact_number.required'    => 'Please enter Primary Mobile Contact Number.',
            // 'full_name_of_emergency_contact.required'   => 'Please enter Full Name of Emergency Contact.',
            // 'relationship.required'                     => 'Please enter Relationship',
            // 'contact_number.required'                   => 'Please enter Contact Number',
        ];

        $this->validate($request, $rules, $messages);

        $data                                       = array();
        $data['resedential_address']                = $request->resedential_address;
        $data['community_name']                     = $request->community_name;
        $data['community_type']                     = $request->community_type;
        $data['province']                           = $request->province;
        $data['district']                           = $request->district;
        $data['postal_address']                     = $request->postal_address;
        $data['email']                              = $request->email;
        $data['landline_contact']                   = $request->landline_contact;
        $data['primary_mobile_contact_number']      = $request->primary_mobile_contact_number;
        $data['other_contact_numbers']              = $request->other_contact_numbers;
        // $data['full_name_of_emergency_contact']     = $request->full_name_of_emergency_contact;
        // $data['relationship']                       = $request->relationship;
        // $data['resedential_address_separate']       = $request->resedential_address_separate;
        // $data['contact_number']                     = $request->contact_number;     

        Session::put('contact-information', $data);

        return redirect()->route('identification-and-employement-details.form')->with('success', 'Contact Information saved successfully');
    }

    // Tab 4

    public function identificationAndEmployementDetailsForm()
    {
        return view('volunteer.identification-and-employement-details');
    }

    public function identificationAndEmployementDetails(Request $request)
    {
        $rules = [
            'photo_id_card_type'               => 'required',
            'specify_photo_id_card_type'       => $request->photo_id_card_type == 'Other' ? 'required' : '',
            'id_card_number'                   => 'required',
            'id_expiry_date'                   => 'required',
            'tin'                              => 'required',
            'current_employment_status'        => 'required',
            'current_occupation'               => ($request->current_employment_status == 'Employed' || $request->current_employment_status == 'Self-Employed') ? 'required' : '',
            'organisation_name'                => ($request->current_employment_status == 'Employed' || $request->current_employment_status == 'Self-Employed') ? 'required' : '',
            'organisation_address'             => ($request->current_employment_status == 'Employed' || $request->current_employment_status == 'Self-Employed') ? 'required' : '',
            'work_contact_number'              => ($request->current_employment_status == 'Employed' || $request->current_employment_status == 'Self-Employed') ? 'required' : '',
        ];

        $messages = [
            'photo_id_card_type.required'          => 'Please select Photo ID Card Type',
            'specify_photo_id_card_type.required'  => 'Please specify Photo ID Card Type.',
            'id_card_number.required'              => 'Please enter ID Card Number',
            'id_expiry_date.required'              => 'Please enter ID Expiry Date.',
            'tin.required'                         => 'Please enter TIN.',
            'current_employment_status.required'   => 'Please select Current Employment Status',
            'current_occupation.required'          => 'Please enter Current Occupation.',
            'organisation_name.required'           => 'Please enter Organisation Name',
            'organisation_address.required'        => 'Please enter Organisation Address.',
            'work_contact_number.required'         => 'Please enter Work Contact Number.',
        ];

        $this->validate($request, $rules, $messages);

        $data                                       = array();
        $data['photo_id_card_type']                 = $request->photo_id_card_type;
        $data['specify_photo_id_card_type']         = $request->specify_photo_id_card_type;
        $data['id_card_number']                     = $request->id_card_number;
        $data['id_expiry_date']                     = $request->id_expiry_date;
        $data['tin']                                = $request->tin;
        $data['current_employment_status']          = $request->current_employment_status;
        $data['current_occupation']                 = $request->current_occupation;
        $data['organisation_name']                  = $request->organisation_name;
        $data['organisation_address']               = $request->organisation_address;
        $data['work_contact_number']                = $request->work_contact_number;

        if ($request->hasfile('photo_id')) {
            $photo_id = $request->file('photo_id');
            $name     = time() . '.' . $photo_id->getClientOriginalExtension();
            $photo_id->storeAs('uploads/temp/', $name, 'public');
        }

        $data['photo_id']                           = $request->hasfile('photo_id') ? $name : null;

        Session::put('identification-employment-details', $data);

        return redirect()->route('education-background.form')->with('success', 'Valid National Identification and Employment Details saved successfully');
    }

    // Tab 5
    public function educationBackgroundForm()
    {
        //   session::forget('education-background');
        return view('volunteer.education-background');
    }

    public function educationBackground(Request $request)
    {

        $rules = [
            'highest_level_of_education'             => 'required',
        ];

        $messages = [
            'highest_level_of_education.required'   => 'Please select Highest Level of Education',
        ];

        $this->validate($request, $rules, $messages);

        $data                                       = array();
        $data['highest_level_of_education']         = $request->highest_level_of_education;

        // if(!empty($request->qualification) && is_array($request->qualification)){
        //     foreach($request->qualification as $key => $qualification){
        //         $data['qualifications'][$key]['year']          = $qualification['year'];
        //         $data['qualifications'][$key]['institution']   = $qualification['institution'];
        //         $data['qualifications'][$key]['course']        = $qualification['course'];
        //         $data['qualifications'][$key]['course_status'] = $qualification['course_status'];

        //         if ($request->hasFile('qualification.'.$key.'.evidence')) {
        //             $qualification_evidence                     = $qualification['evidence'];
        //             $qualification_evidence_name                = time().$key.'.'.$qualification_evidence->getClientOriginalExtension();                       
        //             $qualification_evidence->storeAs('uploads/temp/', $qualification_evidence_name, 'public');                
        //         }  

        //         $data['qualifications'][$key]['evidence']       = $request->hasFile('qualification.'.$key.'.evidence') ? $qualification_evidence_name : '';
        //     }
        // }else{
        //     $data['qualifications'] = [];
        // }

        // if(!empty($request->skill) && is_array($request->skill)){
        //     foreach($request->skill as $key => $skill){
        //         $data['skills'][$key]['skill']                   = $skill['skill'];                  
        //         if ($request->hasFile('skill.'.$key.'.evidence')) {
        //             $skill_evidence                             = $skill['evidence'];
        //             $skill_evidence_name                        = time().$key.'.'.$skill_evidence->getClientOriginalExtension();
        //             $skill_evidence->storeAs('uploads/temp/', $skill_evidence_name, 'public');                
        //         }  
        //         $data['skills'][$key]['evidence']               = $request->hasFile('skill.'.$key.'.evidence') ? $skill_evidence_name : '';
        //     }
        // }else{
        //     $data['skills'] = [];
        // }


        Session::put('education-background', $data);



        return redirect()->route('special-information.form')->with('success', 'Education Background saved successfully');
    }

    // Tab 6
    public function specialInformationForm()
    {
        return view('volunteer.special-information');
    }

    public function specialInformation(Request $request)
    {
        //  $rules = [
        //      'any_police_records'             => 'required',  
        //      'any_special_needs'              => 'required',
        //      'specify_special_needs'          => $request->any_special_needs == "Yes" ? 'required' : '',                  
        //      'any_medical_conditions'         => 'required',  
        //      'specify_medical_conditions'     => $request->any_medical_conditions == "Yes" ? 'required' : '',  
        //      'know_how_to_swim'               => 'required', 
        //      'full_covid_vaccination'         => 'required', 
        //      'blood_donar'                    => 'required',
        //      'know_your_blood_group'          => 'required',
        //      'blood_group'                    => $request->know_your_blood_group == "Yes" ? 'required' : ''
        // ];

        //  $messages = [
        //      'any_police_records.required'           => 'Please select if there is any police records',
        //      'any_special_needs.required'            => 'Please select if there is any police needs', 
        //      'specify_special_needs.required'        => 'Please specify special needs', 
        //      'any_medical_conditions.required'       => 'Please select if there are any medical conditions', 
        //      'specify_medical_conditions.required'   => 'Please specify Medical conditions',  
        //      'know_how_to_swim.required'             => 'Please select if you know how to swim',
        //      'full_covid_vaccination.required'       => 'Please select if you are Full Covid 19 Vaccinated',                   
        //      'blood_donar.required'                  => 'Please select if you are a Blood  donar',
        //      'know_your_blood_group.required'        => 'Please select if you know your Blood Group',
        //      'blood_group'                           => 'Please select Blood Group'
        //  ];

        //  $this->validate($request, $rules, $messages);

        //  $data                                       = array();
        //  $data['any_police_records']                 = $request->any_police_records;
        //  $data['any_special_needs']                  = $request->any_special_needs;
        //  $data['specify_special_needs']              = $request->specify_special_needs;
        //  $data['any_medical_conditions']             = $request->any_medical_conditions;
        //  $data['specify_medical_conditions']         = $request->specify_medical_conditions;
        //  $data['know_how_to_swim']                   = $request->know_how_to_swim;
        //  $data['full_covid_vaccination']             = $request->full_covid_vaccination;
        //  $data['date_first_vaccine']                 = $request->date_first_vaccine;
        //  $data['date_second_vaccine']                = $request->date_second_vaccine;
        //  $data['date_booster']                       = $request->date_booster; 
        //  $data['blood_donar']                        = $request->blood_donar;
        //  $data['know_your_blood_group']              = $request->know_your_blood_group;
        //  $data['blood_group']                        = $request->blood_group;        

        if (!empty($request->volunteer) && is_array($request->volunteer)) {
            foreach ($request->volunteer as $key => $volunteer) {
                $data['volunteers'][$key]['year']                         = $volunteer['year'];
                $data['volunteers'][$key]['experience']                    = $volunteer['experience'];
                $data['volunteers'][$key]['red_cross_involvement']        = $volunteer['red_cross_involvement'];
            }
        } else {
            $data['volunteers'] = [];
        }

        Session::put('special-information', $data);

        return redirect()->route('consents-and-checks.form')->with('success', 'Banking Information saved successfully');
    }

    // Tab 7
    public function serviceInterestForm()
    {
        return view('volunteer.service-interest');
    }

    public function serviceInterest(Request $request)
    {
        $rules = [
            'service_interest'               => 'required',
            'available_days'                 => 'required',
            'available_times'                => 'required'
        ];

        $messages = [
            'service_interest.required'           => 'Please select your Service Interest(s)',
            'available_days.required'             => 'Please select on which days are you available',
            'available_times.required'            => 'Please select on which times are you available',
        ];

        $this->validate($request, $rules, $messages);

        $data                                       = array();
        $data['service_interest']                   = $request->service_interest;
        $data['available_days']                     = $request->available_days;
        $data['available_times']                    = $request->available_times;
        $data['other_skills']                       = $request->other_skills;

        Session::put('service-interest', $data);

        return redirect()->route('banking-information.form')->with('success', 'Service Interest saved successfully');
    }

    // Tab 8
    public function bankingInformationForm()
    {
        return view('volunteer.banking-information');
    }

    public function bankingInformation(Request $request)
    {
        $rules = [
            //   'bank'                        => 'required',  
            //   'account_number'              => 'required',
            //   'name_bank_account'           => 'required',
            'mobile_bank'                 => 'required',
            'mobile_bank_number'          => 'required',
            'name_mobile_bank_account'    => 'required'
        ];

        $messages = [
            //   'bank.required'                       => 'Please select your Bank',
            //   'account_number.required'             => 'Please enter your Account Number', 
            //   'name_bank_account.required'          => 'Please enter Name as used with Bank Account',  
            'mobile_bank.required'                => 'Please select your Mobile Bank',
            'mobile_bank_number.required'         => 'Please enter Mobile Number registered with Mobile banking Service',
            'name_mobile_bank_account.required'   => 'Please enter Name as registered with Mobile banking Service',
        ];

        $this->validate($request, $rules, $messages);

        $data                                       = array();
        //   $data['bank']                               = $request->bank;
        //   $data['account_number']                     = $request->account_number;
        //   $data['name_bank_account']                  = $request->name_bank_account;
        $data['mobile_bank']                        = $request->mobile_bank;
        $data['mobile_bank_number']                 = $request->mobile_bank_number;
        $data['name_mobile_bank_account']           = $request->name_mobile_bank_account;

        Session::put('banking-information', $data);

        return redirect()->route('consents-and-checks.form')->with('success', 'Banking Information saved successfully');
    }

    // Tab 9
    public function consentsAndChecksForm()
    {
        return view('volunteer.consents-and-checks');
    }

    public function consentsAndChecks(Request $request)
    {
        $rules = [
            'consent_to_be_contacted'                 => 'required',
            'consent_to_background_check'             => 'required',
            'parental_consent'                        => 'required',
            'media_consent'                           => 'required',
            'agree_to_code_of_conduct'                => 'required',
            'agree_to_child_protection_policy'        => 'required',
            'age_under_18'                            => 'required',
            'statutory_declaration_attached'          => 'required',
            'code_of_conduct_attached'                => 'required',
            'signed_child_protection_policy_attached' => 'required',
            'professional_volunteer'                  => 'required',
            'base_location'                           => 'required',
        ];

        $messages = [
            'consent_to_be_contacted.required'                 => 'Please select Consent to be contacted',
            'consent_to_background_check.required'             => 'Please select Consent to Background Check',
            'parental_consent.required'                        => 'Please select Parental Consent',
            'media_consent.required'                           => 'Please select Media Consent',
            'agree_to_code_of_conduct.required'                => 'Please select if agree to code of conduct',
            'agree_to_child_protection_policy.required'        => 'Please select if agree to child protection policy',
            'age_under_18.required'                            => 'Please select if age is under 18',
            'statutory_declaration_attached.required'          => 'Please select if Statutory declaration attached',
            'code_of_conduct_attached.required'                => 'Please select if code of conduct attached',
            'signed_child_protection_policy_attached.required' => 'Please select if signed child protection policy attached',
            'professional_volunteer.required'                  => 'Please select if CV attached',
            'base_location.required'                           => 'Please select base location',
        ];

        $this->validate($request, $rules, $messages);

        $data                                             = array();
        $data['consent_to_be_contacted']                  = $request->consent_to_be_contacted;
        $data['consent_to_background_check']              = $request->consent_to_background_check;
        $data['parental_consent']                         = $request->parental_consent;
        $data['media_consent']                            = $request->media_consent;
        $data['agree_to_code_of_conduct']                 = $request->agree_to_code_of_conduct;
        $data['agree_to_child_protection_policy']         = $request->agree_to_child_protection_policy;
        $data['age_under_18']                             = $request->age_under_18;
        $data['statutory_declaration_attached']           = $request->statutory_declaration_attached;
        if ($request->hasfile('statutory_declaration')) {
            $statutory_declaration = $request->file('statutory_declaration');
            $name     = time() . '.' . $statutory_declaration->getClientOriginalExtension();
            $statutory_declaration->storeAs('uploads/temp/', $name, 'public');
        }
        $data['statutory_declaration']                    = $request->hasfile('statutory_declaration') ? $name : null;
        $data['code_of_conduct_attached']                 = $request->code_of_conduct_attached;
        if ($request->hasfile('code_of_conduct')) {
            $code_of_conduct = $request->file('code_of_conduct');
            $name     = time() . '.' . $code_of_conduct->getClientOriginalExtension();
            $code_of_conduct->storeAs('uploads/temp/', $name, 'public');
        }
        $data['code_of_conduct']                          = $request->hasfile('code_of_conduct') ? $name : null;
        $data['signed_child_protection_policy_attached']  = $request->signed_child_protection_policy_attached;
        if ($request->hasfile('signed_child_protection_policy')) {
            $signed_child_protection_policy = $request->file('signed_child_protection_policy');
            $name     = time() . '.' . $signed_child_protection_policy->getClientOriginalExtension();
            $signed_child_protection_policy->storeAs('uploads/temp/', $name, 'public');
        }
        $data['signed_child_protection_policy']           = $request->hasfile('signed_child_protection_policy') ? $name : null;
        $data['professional_volunteer']                   = $request->professional_volunteer;
        if ($request->hasfile('professional_volunteer_attachment')) {
            $professional_volunteer_attachment = $request->file('professional_volunteer_attachment');
            $name     = time() . '.' . $professional_volunteer_attachment->getClientOriginalExtension();
            $professional_volunteer_attachment->storeAs('uploads/temp/', $name, 'public');
        }
        $data['professional_volunteer_attachment']        = $request->hasfile('professional_volunteer_attachment') ? $name : null;
        $data['base_location']                            = $request->base_location;

        if (!empty($request->referee) && is_array($request->referee)) {
            foreach ($request->referee as $key => $referee) {
                $data['referees'][$key]['name']                = $referee['name'];
                $data['referees'][$key]['role']                = $referee['role'];
                $data['referees'][$key]['organisation']        = $referee['organisation'];
                $data['referees'][$key]['contact_number']      = $referee['contact_number'];
                $data['referees'][$key]['email']               = $referee['email'];
            }
        } else {
            $data['referees'] = [];
        }

        Session::put('consents-and-checks', $data);

        return redirect()->route('register')->with('success', 'Consents and Checks saved successfully');
    }
}
