<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
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
use App\Models\RefereeInformation;
use App\Models\ServiceInterest;
use App\Models\Skill;
use App\Models\SpecialInformation;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\ValidNationalIdentification;
use App\Models\VolunteeringInformation;
use App\Notifications\NewRegistrationNotification;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname'             => ['required', 'string', 'max:255'],          
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'string', 'min:6'],          
            'phone'                 => ['required', 'max:255'],                        
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([           
            'lastname'      => $data['firstname'],           
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'password'      => Hash::make($data['password']),
        ]);     
        
        $lodgement_information = Session::get('lodgement-information');

        if(isset($lodgement_information)){

            $lodgement_information_data                                      = array();
            $lodgement_information_data['user_id']                           = $user->id;
            $lodgement_information_data['date_of_lodgement']                 = $lodgement_information['date_of_lodgement'];
            $lodgement_information_data['registering_year']                  = $lodgement_information['registering_year'];
            $lodgement_information_data['division']                          = $lodgement_information['division'];
            $lodgement_information_data['registration_location']             = $lodgement_information['registration_location'];
            $lodgement_information_data['registration_location_type']        = $lodgement_information['registration_location_type'];

            LodgementInformation::create($lodgement_information_data);
        }

        $personal_information = Session::get('personal-information');

        if(isset($personal_information)){

            $personal_information_data                                       = array();
            $personal_information_data['user_id']                            = $user->id;
            $personal_information_data['lastname']                           = $personal_information['lastname'];
            $personal_information_data['firstname']                          = $personal_information['firstname'];
            $personal_information_data['other_names']                        = $personal_information['other_names'];
            $personal_information_data['father_name']                        = $personal_information['father_name'];
            $personal_information_data['date_of_birth']                      = $personal_information['date_of_birth'];
            $personal_information_data['sex']                                = $personal_information['sex'];
            $personal_information_data['citizenship']                        = $personal_information['citizenship'];
            $personal_information_data['specify_citizenship']                = $personal_information['specify_citizenship'];        
            $personal_information_data['ethnic_background']                  = $personal_information['ethnic_background'];
            $personal_information_data['specify_ethnic_background']          = $personal_information['specify_ethnic_background'];        
            $personal_information_data['marital_status']                     = $personal_information['marital_status'];
            $personal_information_data['no_of_dependents']                   = $personal_information['no_of_dependents'];
            $personal_information_data['languages_spoken']                   = $personal_information['languages_spoken'];
            $personal_information_data['specify_languages_spoken']           = $personal_information['specify_languages_spoken'];       

            PersonalInformation::create($personal_information_data);
        }

        $contact_information = Session::get('contact-information');

        if(isset($contact_information)){
            $contact_information_data                                       = array();
            $contact_information_data['user_id']                            = $user->id;
            $contact_information_data['resedential_address']                = $contact_information['resedential_address'];
            $contact_information_data['community_name']                     = $contact_information['community_name'];
            $contact_information_data['community_type']                     = $contact_information['community_type'];
            $contact_information_data['province']                           = $contact_information['province'];
            $contact_information_data['district']                           = $contact_information['district'];
            $contact_information_data['postal_address']                     = $contact_information['postal_address'];
            $contact_information_data['email']                              = $contact_information['email'];
            $contact_information_data['landline_contact']                   = $contact_information['landline_contact'];
            $contact_information_data['primary_mobile_contact_number']      = $contact_information['primary_mobile_contact_number'];
            $contact_information_data['primary_mobile_network_provider']    = $contact_information['primary_mobile_network_provider'];
            $contact_information_data['other_contact_numbers']              = $contact_information['other_contact_numbers'];
            $contact_information_data['full_name_of_emergency_contact']     = $contact_information['full_name_of_emergency_contact'];
            $contact_information_data['relationship']                       = $contact_information['relationship'];
            $contact_information_data['resedential_address_separate']       = $contact_information['resedential_address_separate'];
            $contact_information_data['contact_number']                     = $contact_information['contact_number'];

            ContactInformation::create($contact_information_data);
        }

        $identification_employment_details = Session::get('identification-employment-details');

        if(isset($identification_employment_details)){

            $identification_data                                       = array();
            $identification_data['user_id']                            = $user->id;
            $identification_data['photo_id_card_type']                 = $identification_employment_details['photo_id_card_type'];
            $identification_data['specify_photo_id_card_type']         = $identification_employment_details['specify_photo_id_card_type'];
            $identification_data['id_card_number']                     = $identification_employment_details['id_card_number'];
            $identification_data['id_expiry_date']                     = $identification_employment_details['id_expiry_date'];
            $identification_data['tin']                                = $identification_employment_details['tin'];
           
            if(isset($identification_employment_details['photo_id'])){
                Storage::move('/public/uploads/temp/'.$identification_employment_details['photo_id'], '/public/uploads/users/'.$user->id.'/'.$identification_employment_details['photo_id']);
            }            

            $identification_data['photo_id']                           = isset($identification_employment_details['photo_id']) ? $identification_employment_details['photo_id'] : null;

            ValidNationalIdentification::create($identification_data);

            $employment_data                                       = array();
            $employment_data['user_id']                            = $user->id;
            $employment_data['current_employment_status']          = $identification_employment_details['current_employment_status'];
            $employment_data['current_occupation']                 = $identification_employment_details['current_occupation'];
            $employment_data['organisation_name']                  = $identification_employment_details['organisation_name'];
            $employment_data['organisation_address']               = $identification_employment_details['organisation_address'];
            $employment_data['work_contact_number']                = $identification_employment_details['work_contact_number']; 

            EmploymentDetail::create($employment_data);
        }

        $education_background = Session::get('education-background');

        if(isset($education_background)){
            $education_background_data                                       = array();
            $education_background_data['user_id']                            = $user->id;
            $education_background_data['highest_level_of_education']         = $education_background['highest_level_of_education'];

            EducationBackground::create($education_background_data);

            if(!empty($education_background['qualifications']) && is_array($education_background['qualifications'])){
                foreach($education_background['qualifications'] as $key => $qualification){
                    if(isset($qualification['evidence'])){
                        Storage::move('/public/uploads/temp/'.$qualification['evidence'], '/public/uploads/users/'.$user->id.'/'.'qualifications/'.$qualification['evidence']);
                    }  
                    $qual                  = new Qualification;
                    $qual->user_id         = $user->id;
                    $qual->year            = $qualification['year'];
                    $qual->institution     = $qualification['institution'];
                    $qual->course          = $qualification['course'];
                    $qual->course_status   = $qualification['course_status'];
                    $qual->evidence        = isset($qualification['evidence']) ? $qualification['evidence'] : null;
                    $qual->save();
                }
            }

            if(!empty($education_background['skills']) && is_array($education_background['skills'])){
                foreach($education_background['skills'] as $key => $skill){
                    if(isset($skill['evidence'])){
                        Storage::move('/public/uploads/temp/'.$skill['evidence'], '/public/uploads/users/'.$user->id.'/'.'skills/'.$skill['evidence']);
                    }  
                    $skil                  = new Skill();
                    $skil->user_id         = $user->id;
                    $skil->skill           = $skill['skill'];  
                    $skil->evidence        = isset($skill['evidence']) ? $skill['evidence'] : null;                 
                    $skil->save();
                }
            }
        }

        $special_information = Session::get('special-information');

        if(isset($special_information)){
            $special_information_data                                       = array();
            $special_information_data['user_id']                            = $user->id;
            $special_information_data['any_police_records']                 = $special_information['any_police_records'];
            $special_information_data['any_special_needs']                  = $special_information['any_special_needs'];
            $special_information_data['specify_special_needs']              = $special_information['specify_special_needs'];
            $special_information_data['any_medical_conditions']             = $special_information['any_medical_conditions'];
            $special_information_data['specify_medical_conditions']         = $special_information['specify_medical_conditions'];
            $special_information_data['know_how_to_swim']                   = $special_information['know_how_to_swim'];
            $special_information_data['full_covid_vaccination']             = $special_information['full_covid_vaccination'];
            $special_information_data['date_first_vaccine']                 = $special_information['date_first_vaccine'];
            $special_information_data['date_second_vaccine']                = $special_information['date_second_vaccine'];
            $special_information_data['date_booster']                       = $special_information['date_booster']; 
           
            SpecialInformation::create($special_information_data);

            $blood_information                                       = array();
            $blood_information['user_id']                            = $user->id;
            $blood_information['blood_donar']                        = $special_information['blood_donar'];
            $blood_information['know_your_blood_group']              = $special_information['know_your_blood_group'];
            $blood_information['blood_group']                        = $special_information['blood_group'];

            BloodInformation::create($blood_information);

            if(!empty($special_information['volunteers']) && is_array($special_information['volunteers'])){
                foreach($special_information['volunteers'] as $key => $volunteer){                    
                    $volun                               = new VolunteeringInformation();
                    $volun->user_id                      = $user->id;
                    $volun->year                         = $volunteer['year'];
                    $volun->experience                   = $volunteer['experience'];
                    $volun->red_cross_involvement        = $volunteer['red_cross_involvement'];                    
                    $volun->save();
                }
            }
        }

        $service_interest =  Session::get('service-interest');

        if(isset($service_interest)){

          $service_interest_data                                       = array();
          $service_interest_data['user_id']                            = $user->id;
          $service_interest_data['service_interest']                   = $service_interest['service_interest'];
          $service_interest_data['available_days']                     = $service_interest['available_days'];
          $service_interest_data['available_times']                    = $service_interest['available_times'];
          $service_interest_data['other_skills']                       = $service_interest['other_skills'];

          ServiceInterest::create($service_interest_data);
        }

        $banking_information =  Session::get('banking-information');

        if(isset($banking_information)){
            $personal_banking_information_data                                       = array();
            $personal_banking_information_data['user_id']                            = $user->id;
            $personal_banking_information_data['bank']                               = $banking_information['bank'];
            $personal_banking_information_data['account_number']                     = $banking_information['account_number'];
            $personal_banking_information_data['name_bank_account']                  = $banking_information['name_bank_account'];
            PersonalBankingInformation::create($personal_banking_information_data);
            
            $mobile_banking_information_data                                         = array();
            $mobile_banking_information_data['user_id']                              = $user->id;
            $mobile_banking_information_data['mobile_bank']                          = $banking_information['mobile_bank'];  
            $mobile_banking_information_data['mobile_bank_number']                   = $banking_information['mobile_bank_number'];
            $mobile_banking_information_data['name_mobile_bank_account']             = $banking_information['name_mobile_bank_account'];
            MobileBankingInformation::create($mobile_banking_information_data);
        }

        $consents_and_checks =  Session::get('consents-and-checks');

        if(isset($consents_and_checks)){
            if(!empty($consents_and_checks['referees']) && is_array($consents_and_checks['referees'])){
                foreach($consents_and_checks['referees'] as $key => $referee){                    
                    $refr                  = new RefereeInformation();
                    $refr->user_id         = $user->id;
                    $refr->name            = $referee['name'];
                    $refr->role            = $referee['role'];
                    $refr->organisation    = $referee['organisation'];
                    $refr->contact_number  = $referee['contact_number'];  
                    $refr->email           = $referee['email'];                  
                    $refr->save();
                }
            }

            $consent_data                                             = array();
            $consent_data['user_id']                                  = $user->id;
            $consent_data['consent_to_be_contacted']                  = $consents_and_checks['consent_to_be_contacted'];
            $consent_data['consent_to_background_check']              = $consents_and_checks['consent_to_background_check'];
            $consent_data['parental_consent']                         = $consents_and_checks['parental_consent'];
            $consent_data['media_consent']                            = $consents_and_checks['media_consent'];  
            $consent_data['agree_to_code_of_conduct']                 = $consents_and_checks['agree_to_code_of_conduct'];
            $consent_data['agree_to_child_protection_policy']         = $consents_and_checks['agree_to_child_protection_policy'];  

            Consent::create($consent_data);

            $check_data                                             = array();
            $check_data['user_id']                                  = $user->id;
            $check_data['statutory_declaration_attached']           = $consents_and_checks['statutory_declaration_attached'];
            $check_data['code_of_conduct_attached']                 = $consents_and_checks['code_of_conduct_attached'];
            $check_data['signed_child_protection_policy_attached']  = $consents_and_checks['signed_child_protection_policy_attached'];  
            $check_data['cv_attached']                              = $consents_and_checks['cv_attached'];
            $check_data['base_location']                            = $consents_and_checks['base_location']; 

            Check::create($check_data);
        }

        $admins = Admin::role('branch-level')->where('branch', $lodgement_information['registration_location_type'])->get();
        $when   = Carbon::now()->addSecond(10);
        Notification::send($admins, new NewRegistrationNotification());
             
        
        return $user;
    }
}
