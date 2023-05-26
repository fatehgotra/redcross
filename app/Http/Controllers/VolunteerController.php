<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'date_of_lodgement'             => 'required',
            'registering_year'              => 'required',
            'division'                      => 'required',
            'registration_location'         => 'required',
            'registration_location_type'    => 'required',
        ];

        $messages = [
            'date_of_lodgement.required'               => 'Please enter Date of Lodgement',
            'registering_year.required'                => 'Please enter Registering Year.',
            'division.required'                        => 'Please select Division',
            'registration_location.required'           => 'Please enter Registration Location.',
            'registration_location_type.required'      => 'Please select Location Type.'
        ];

        $this->validate($request, $rules, $messages);

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
            'lastname'                  => 'required',
            'firstname'                 => 'required',
            'father_name'               => 'required',
            'date_of_birth'             => 'required',
            'sex'                       => 'required',
            'citizenship'               => 'required',
            'specify_citizenship'       => $request->citizenship == 'Other' ? 'required' : '',
            'ethnic_background'         => 'required|array|min:1',
            'specify_ethnic_background' => is_array($request->ethnic_background) ? (in_array('Other', $request->ethnic_background) ? 'required' : '') : '',
            'marital_status'            => 'required',
            'no_of_dependents'          => 'required',
            'languages_spoken'          => 'required|array|min:1',
            'specify_languages_spoken'  => is_array($request->languages_spoken) ? (in_array('Other Languages', $request->languages_spoken) ? 'required' : '') : '',
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
            'languagees_spoken.required'            => 'Please select Languages Spoken.',
            'specify_languagees_spoken.required'    => 'Please specify Languages Spoken.',
        ];

        $this->validate($request, $rules, $messages);

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
                'primary_mobile_network_provider'   => 'required',
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
                'primary_mobile_network_provider.required'  => 'Please select Primary Mobile Network Provider.',
                'full_name_of_emergency_contact.required'   => 'Please enter Full Name of Emergency Contact.',
                'relationship.required'                     => 'Please enter Relationship',
                'contact_number.required'                   => 'Please enter Contact Number',
            ];
    
            $this->validate($request, $rules, $messages);
    
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
    
            return redirect()->route('education-background.form')->with('success', 'Valid National Identification and Employment Details saved successfully');
        }

        // Tab 5
        public function educationBackgroundForm()
    {
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

        return redirect()->route('special-information.form')->with('success', 'Education Background saved successfully');
    }

     // Tab 6
     public function specialInformationForm()
     {
         return view('volunteer.special-information');
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
 
         return redirect()->route('service-interest.form')->with('success', 'Special Information saved successfully');
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
              'statutory_declaration_attached'          => 'required',  
              'code_of_conduct_attached'                => 'required',
              'signed_child_protection_policy_attached' => 'required',
              'cv_attached'                             => 'required',  
              'base_location'                           => 'required',  
         ];
 
          $messages = [
              'consent_to_be_contacted.required'                 => 'Please select Consent to be contacted',
              'consent_to_background_check.required'             => 'Please select Consent to Background Check', 
              'parental_consent.required'                        => 'Please select Parental Consent',  
              'media_consent.required'                           => 'Please select Media Consent',
              'agree_to_code_of_conduct.required'                => 'Please select if agree to code of conduct', 
              'agree_to_child_protection_policy.required'        => 'Please select if agree to child protection policy',  
              'statutory_declaration_attached.required'          => 'Please select if Statutory declaration attached',  
              'code_of_conduct_attached.required'                => 'Please select if code of conduct attached',
              'signed_child_protection_policy_attached.required' => 'Please select if signed child protection policy attached',
              'cv_attached.required'                             => 'Please select if CV attached',  
              'base_location.required'                           => 'Please select base location',             
          ];
  
          $this->validate($request, $rules, $messages);
  
          return redirect()->route('service-interest.form')->with('success', 'Consents and Checks saved successfully');
      }

}
