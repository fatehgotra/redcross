<?php

namespace App\Http\Controllers;

use App\Models\BloodInformation;
use App\Models\Check;
use App\Models\Consent;
use App\Models\ContactInformation;
use App\Models\EducationBackground;
use App\Models\EmploymentDetail;
use App\Models\LodgementInformation;
use App\Models\MobileBankingInformation;
use App\Models\PersonalBankingInformation;
use App\Models\PersonalInformation;
use App\Models\Qualification;
use App\Models\Receipts;
use App\Models\RefereeInformation;
use App\Models\ServiceInterest;
use App\Models\Skill;
use App\Models\SpecialInformation;
use App\Models\ValidNationalIdentification;
use App\Models\VolunteeringInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'approved']);
    }

    // Tab 1
    public function lodgeInformationForm()
    {
        $user = Auth::user();
        $lodgement_information = Auth::user()->lodgementInformation;
        return view('user.my-profile.lodge-information', compact('lodgement_information', 'user'));
    }

    public function lodgeInformation(Request $request)
    {
        $rules = [
            'date_of_lodgement'                    => 'required',
            'registering_year'                     => 'required',
            'division'                             => 'required',
            'registration_location_type'           => 'required',
        ];

        $messages = [
            'date_of_lodgement.required'           => 'Please enter Date of Lodgement',
            'registering_year.required'            => 'Please enter Registering Year.',
            'division.required'                    => 'Please select Division',
            'registration_location_type.required'  => 'Please select your nearest branch.'
        ];

        $this->validate($request, $rules, $messages);

        $data                                      = array();
        $data['date_of_lodgement']                 = $request->date_of_lodgement;
        $data['registering_year']                  = $request->registering_year;
        $data['division']                          = $request->division;
        $data['registration_location_type']        = $request->registration_location_type;

        LodgementInformation::updateOrCreate(['user_id' => Auth::user()->id], $data);

        return redirect()->back()->with('success', 'Lodgement Information updated successfully');
    }

    // Tab 2
    public function personalInformationForm()
    {
        $personal_information = Auth::user()->personalInformation;
        return view('user.my-profile.personal-information', compact('personal_information'));
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
            'no_of_dependents'                      => 'required',
            'languages_spoken'                      => 'required|array|min:1',
            'specify_languages_spoken'              => is_array($request->languages_spoken) ? (in_array('Other Languages', $request->languages_spoken) ? 'required' : '') : '',
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
            'no_of_dependents.required'             => 'Please enter No. of Dependents.',
            'languages_spoken.required'             => 'Please select Languages Spoken.',
            'specify_languages_spoken.required'     => 'Please specify Languages Spoken.',
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
        $data['no_of_dependents']                   = $request->no_of_dependents;
        $data['languages_spoken']                   = $request->languages_spoken;
        $data['specify_languages_spoken']           = $request->specify_languages_spoken;

        PersonalInformation::updateOrCreate(['user_id' => Auth::user()->id], $data);

        return redirect()->back()->with('success', 'Personal Information updated successfully');
    }

    // Tab 3
    public function contactInformationForm()
    {
        $contact_information = Auth::user()->contactInformation;
        return view('user.my-profile.contact-information', compact('contact_information'));
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
            'full_name_of_emergency_contact'    => 'required',
            'relationship'                      => 'required',
            'contact_number'                    => 'required',
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
            'full_name_of_emergency_contact.required'   => 'Please enter Full Name of Emergency Contact.',
            'relationship.required'                     => 'Please enter Relationship',
            'contact_number.required'                   => 'Please enter Contact Number',
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
        $data['full_name_of_emergency_contact']     = $request->full_name_of_emergency_contact;
        $data['relationship']                       = $request->relationship;
        $data['resedential_address_separate']       = $request->resedential_address_separate;
        $data['contact_number']                     = $request->contact_number;

        ContactInformation::updateOrCreate(['user_id' => Auth::user()->id], $data);

        return redirect()->back()->with('success', 'Contact Information updated successfully');
    }

    // Tab 4

    public function identificationAndEmployementDetailsForm()
    {
        $identification_details = Auth::user()->validNationalIdentification;
        $employment_details     = Auth::user()->employmentDetail;
        return view('user.my-profile.identification-and-employement-details', compact('identification_details', 'employment_details'));
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

        $identification_data                                       = array();
        $identification_data['photo_id_card_type']                 = $request->photo_id_card_type;
        $identification_data['specify_photo_id_card_type']         = $request->specify_photo_id_card_type;
        $identification_data['id_card_number']                     = $request->id_card_number;
        $identification_data['id_expiry_date']                     = $request->id_expiry_date;
        $identification_data['tin']                                = $request->tin;
        if ($request->hasfile('photo_id')) {
            $photo_id = $request->file('photo_id');
            $name     = time() . '.' . $photo_id->getClientOriginalExtension();
            $photo_id->storeAs('uploads/users/' . Auth::user()->id . '/', $name, 'public');
            $identification_data['photo_id']                           = $name;
        }

        ValidNationalIdentification::updateOrCreate(['user_id' => Auth::user()->id], $identification_data);

        $employment_data                                       = array();
        $employment_data['current_employment_status']          = $request->current_employment_status;
        $employment_data['current_occupation']                 = $request->current_occupation;
        $employment_data['organisation_name']                  = $request->organisation_name;
        $employment_data['organisation_address']               = $request->organisation_address;
        $employment_data['work_contact_number']                = $request->work_contact_number;

        EmploymentDetail::updateOrCreate(['user_id' => Auth::user()->id], $employment_data);

        return redirect()->back()->with('success', 'Valid National Identification and Employment Details updated successfully');
    }

    // Tab 5
    public function educationBackgroundForm()
    {
        $education_background   = Auth::user()->educationBackgroud;
        $qualifications         = Auth::user()->qualifications;
        $skills                 = Auth::user()->skills;
        return view('user.my-profile.education-background', compact('education_background', 'qualifications', 'skills'));
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

        $education_background_data                                       = array();
        $education_background_data['highest_level_of_education']         = $request->highest_level_of_education;
        EducationBackground::updateOrCreate(['user_id' => Auth::user()->id], $education_background_data);

        // Qualification::where('user_id', Auth::user()->id)->delete();
        // if (!empty($request->qualification) && is_array($request->qualification)) {
        //     foreach ($request->qualification as $key => $qualification) {
        //         $qual                  = new Qualification();
        //         $qual->user_id         = Auth::user()->id;
        //         $qual->year            = $qualification['year'];
        //         $qual->institution     = $qualification['institution'];
        //         $qual->course          = $qualification['course'];
        //         $qual->course_status   = $qualification['course_status'];
                // $qual->evidence        = isset($qualification['evidence']) ? $qualification['evidence'] : null;
        //         $qual->save();
        //     }
        // }
        // Skill::where('user_id', Auth::user()->id)->delete();
        // if (!empty($request->skill) && is_array($request->skill)) {
        //     foreach ($request->skill as $key => $skill) {
        //         $skil                  = new Skill();
        //         $skil->user_id         = Auth::user()->id;
        //         $skil->skill           = $skill['skill'];  
                // $skil->evidence        = isset($skill['evidence']) ? $skill['evidence'] : null;                 
        //         $skil->save();
        //     }
        // }

        return redirect()->back()->with('success', 'Education Background updated successfully');
    }

    // Tab 6
    public function specialInformationForm()
    {
        $special_information   = Auth::user()->specialInformation;
        $blood_information   = Auth::user()->bloodInformation;
        $volunteers   = Auth::user()->volunteers;
        return view('user.my-profile.special-information', compact('special_information', 'blood_information', 'volunteers'));
    }

    public function specialInformation(Request $request)
    {
        $rules = [
            'any_police_records'             => 'required',
            'any_special_needs'              => 'required',
            'specify_special_needs'          => $request->any_special_needs == "Yes" ? 'required' : '',
            'any_medical_conditions'         => 'required',
            'specify_medical_conditions'     => $request->any_medical_conditions == "Yes" ? 'required' : '',
            'know_how_to_swim'               => 'required',
            'full_covid_vaccination'         => 'required',
            'blood_donar'                    => 'required',
            'know_your_blood_group'          => 'required',
            'blood_group'                    => $request->know_your_blood_group == "Yes" ? 'required' : ''
        ];

        $messages = [
            'any_police_records.required'           => 'Please select if there is any police records',
            'any_special_needs.required'            => 'Please select if there is any police needs',
            'specify_special_needs.required'        => 'Please specify special needs',
            'any_medical_conditions.required'       => 'Please select if there are any medical conditions',
            'specify_medical_conditions.required'   => 'Please specify Medical conditions',
            'know_how_to_swim.required'             => 'Please select if you know how to swim',
            'full_covid_vaccination.required'       => 'Please select if you are Full Covid 19 Vaccinated',
            'blood_donar.required'                  => 'Please select if you are a Blood  donar',
            'know_your_blood_group.required'        => 'Please select if you know your Blood Group',
            'blood_group'                           => 'Please select Blood Group'
        ];

        $this->validate($request, $rules, $messages);

        $special_information_data                                       = array();
        $special_information_data['any_police_records']                 = $request->any_police_records;
        $special_information_data['any_special_needs']                  = $request->any_special_needs;
        $special_information_data['specify_special_needs']              = $request->specify_special_needs;
        $special_information_data['any_medical_conditions']             = $request->any_medical_conditions;
        $special_information_data['specify_medical_conditions']         = $request->specify_medical_conditions;
        $special_information_data['know_how_to_swim']                   = $request->know_how_to_swim;
        $special_information_data['full_covid_vaccination']             = $request->full_covid_vaccination;
        $special_information_data['date_first_vaccine']                 = $request->date_first_vaccine;
        $special_information_data['date_second_vaccine']                = $request->date_second_vaccine;
        $special_information_data['date_booster']                       = $request->date_booster;

        SpecialInformation::updateOrCreate(['user_id' => Auth::user()->id], $special_information_data);


        $blood_information_data                                       = array();
        $blood_information_data['blood_donar']                        = $request->blood_donar;
        $blood_information_data['know_your_blood_group']              = $request->know_your_blood_group;
        $blood_information_data['blood_group']                        = $request->blood_group;

        BloodInformation::updateOrCreate(['user_id' => Auth::user()->id], $blood_information_data);

        VolunteeringInformation::where('user_id', Auth::user()->id)->delete();
        if (!empty($request->volunteer) && is_array($request->volunteer)) {
            foreach ($request->volunteer as $key => $volunteer) {
                    $volun                               = new VolunteeringInformation();
                    $volun->user_id                      = Auth::user()->id;
                    $volun->year                         = $volunteer['year'];
                    $volun->experience                   = $volunteer['experience'];
                    $volun->red_cross_involvement        = $volunteer['red_cross_involvement'];                    
                    $volun->save();
            }
        }

        return redirect()->back()->with('success', 'Special Information updated successfully');
    }

    // Tab 7
    public function serviceInterestForm()
    {
        $service_interest   = Auth::user()->serviceInterest;
        return view('user.my-profile.service-interest', compact('service_interest'));
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

        ServiceInterest::updateOrCreate(['user_id' => Auth::user()->id], $data);

        return redirect()->back()->with('success', 'Service Interest updated successfully');
    }

    // Tab 8
    public function bankingInformationForm()
    {

        $personal_banking_information   = Auth::user()->personalBankingInformation;
        $mobile_banking_information   = Auth::user()->mobileBankingInformation;
        return view('user.my-profile.banking-information', compact('personal_banking_information', 'mobile_banking_information'));
    }

    public function bankingInformation(Request $request)
    {
        $rules = [
            'bank'                        => 'required',
            'account_number'              => 'required',
            'name_bank_account'           => 'required',
            'mobile_bank'                 => 'required',
            'mobile_bank_number'          => 'required',
            'name_mobile_bank_account'    => 'required'
        ];

        $messages = [
            'bank.required'                       => 'Please select your Bank',
            'account_number.required'             => 'Please enter your Account Number',
            'name_bank_account.required'          => 'Please enter Name as used with Bank Account',
            'mobile_bank.required'                => 'Please select your Mobile Bank',
            'mobile_bank_number.required'         => 'Please enter Mobile Number registered with Mobile banking Service',
            'name_mobile_bank_account.required'   => 'Please enter Name as registered with Mobile banking Service',
        ];

        $this->validate($request, $rules, $messages);

        $personal_banking_data                                       = array();
        $personal_banking_data['bank']                               = $request->bank;
        $personal_banking_data['account_number']                     = $request->account_number;
        $personal_banking_data['name_bank_account']                  = $request->name_bank_account;
        PersonalBankingInformation::updateOrCreate(['user_id' => Auth::user()->id], $personal_banking_data);

        $mobile_banking_data                                       = array();
        $mobile_banking_data['mobile_bank']                        = $request->mobile_bank;
        $mobile_banking_data['mobile_bank_number']                 = $request->mobile_bank_number;
        $mobile_banking_data['name_mobile_bank_account']           = $request->name_mobile_bank_account;
        MobileBankingInformation::updateOrCreate(['user_id' => Auth::user()->id], $mobile_banking_data);

        return redirect()->back()->with('success', 'Banking Information updated successfully');
    }

    // Tab 9
    public function consentsAndChecksForm()
    {
        $consents   = Auth::user()->consents;
        $checks   = Auth::user()->checks;
        $referees   = Auth::user()->referees;
        return view('user.my-profile.consents-and-checks', compact('consents', 'checks', 'referees'));
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
            'professional_volunteer.required'                             => 'Please select if CV attached',
            'base_location.required'                           => 'Please select base location',
        ];

        $this->validate($request, $rules, $messages);

        $consent_data                                             = array();
        $consent_data['consent_to_be_contacted']                  = $request->consent_to_be_contacted;
        $consent_data['consent_to_background_check']              = $request->consent_to_background_check;
        $consent_data['parental_consent']                         = $request->parental_consent;
        $consent_data['media_consent']                            = $request->media_consent;
        $consent_data['agree_to_code_of_conduct']                 = $request->agree_to_code_of_conduct;
        $consent_data['agree_to_child_protection_policy']         = $request->agree_to_child_protection_policy;
        $consent_data['age_under_18']                             = $request->age_under_18;
        Consent::updateOrCreate(['user_id' => Auth::user()->id], $consent_data);

        $check_data                                             = array();
        $check_data['statutory_declaration_attached']           = $request->statutory_declaration_attached;
        if ($request->hasfile('statutory_declaration')) {
            $statutory_declaration = $request->file('statutory_declaration');
            $sdname     = time() . '.' . $statutory_declaration->getClientOriginalExtension();
            $statutory_declaration->storeAs('uploads/users/' . Auth::user()->id . '/checks', $sdname, 'public');
            $check_data['statutory_declaration']                = $sdname;
        }
        $check_data['code_of_conduct_attached']                 = $request->code_of_conduct_attached;
        if ($request->hasfile('code_of_conduct')) {
            $code_of_conduct = $request->file('code_of_conduct');
            $cocname     = time() . '.' . $code_of_conduct->getClientOriginalExtension();
            $code_of_conduct->storeAs('uploads/users/' . Auth::user()->id . '/checks', $cocname, 'public');
            $check_data['code_of_conduct']                      = $cocname;
        }
        $check_data['signed_child_protection_policy_attached']  = $request->signed_child_protection_policy_attached;
        if ($request->hasfile('signed_child_protection_policy')) {
            $signed_child_protection_policy = $request->file('signed_child_protection_policy');
            $scppname     = time() . '.' . $signed_child_protection_policy->getClientOriginalExtension();
            $signed_child_protection_policy->storeAs('uploads/users/' . Auth::user()->id . '/checks', $scppname, 'public');
            $check_data['signed_child_protection_policy']       = $scppname;
        }
        $check_data['professional_volunteer']                   = $request->professional_volunteer;
        if ($request->hasfile('professional_volunteer_attachment')) {
            $professional_volunteer_attachment = $request->file('professional_volunteer_attachment');
            $pvaname     = time() . '.' . $professional_volunteer_attachment->getClientOriginalExtension();
            $professional_volunteer_attachment->storeAs('uploads/users/' . Auth::user()->id . '/checks', $pvaname, 'public');
            $check_data['professional_volunteer_attachment']    = $pvaname;
        }
        $check_data['base_location']                            = $request->base_location;
        Check::updateOrCreate(['user_id' => Auth::user()->id], $check_data);

        RefereeInformation::where('user_id', Auth::user()->id)->delete();
        if (!empty($request->referee) && is_array($request->referee)) {
            foreach ($request->referee as $key => $referee) {
                $refr                  = new RefereeInformation();
                $refr->user_id         = Auth::user()->id;
                $refr->name            = $referee['name'];
                $refr->role            = $referee['role'];
                $refr->organisation    = $referee['organisation'];
                $refr->contact_number  = $referee['contact_number'];  
                $refr->email           = $referee['email'];                  
                $refr->save();
            }
        }     

        return redirect()->back()->with('success', 'Consents and Checks updated successfully');
    }

    public function receiptForm(){

        $receipts = Receipts::where('email',Auth::user()->email)->get();

        return view('user.my-profile.receipt-form',compact('receipts'));
    }
}
