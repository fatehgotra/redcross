<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    // Step 1
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

    // Step 2
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

        // Step 3
        public function contactInformationForm()
        {
            return view('volunteer.contact-information');
        }
    
        public function contactInformation(Request $request)
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
    
            return redirect()->route('contact-information.form')->with('success', 'Personal Information saved successfully');
        }

}
