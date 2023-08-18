<?php

namespace Database\Seeders;

use App\Models\BloodInformation;
use App\Models\Check;
use App\Models\CommunityActivity;
use App\Models\CommunityAttendees;
use App\Models\CommunityAttendence;
use App\Models\CommunityDocs;
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
use App\Models\User;
use App\Models\UserHours;
use App\Models\ValidNationalIdentification;
use App\Models\VolunteeringInformation;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        $branches[0] = "Rotuma";
        $branches[1] = "Levuka";
        $branches[2] = "Suva";
        $branches[3] = "Bua";
        $branches[4] = "Seaqaqa";
        $branches[5] = "Savusavu";
        $branches[6] = "Labasa";
        $branches[7] = "Taveuni";
        $branches[8] = "Rabi";
        $branches[9] = "Sigatoka";
        $branches[10] = "Nadi";
        $branches[11] = "Lautoka";
        $branches[12] = "Ba";
        $branches[13] = "Tavua";
        $branches[14] = "Rakiraki";
        $branches[15] = "Nalawa";
    

        $address = [
            
           'Rotuma'    => [ 'Rotuma Airport (RTA), Fiji' ,'· Mountain peak, Rotuma', 'Hauameamea Island, Rotuma', 'Sisilo , Rotuma'],
           'Levuka'    => ['Port of Levuka','Wharf Levuka, Fiji','8R8P+2W8, Levuka, Fiji','8R8M+WPM, Levuka, Fiji'],
           'Suva'      => ['Albert Park, Suva', 'Fiji Museum, Suva','Thurston Gardens, Suva', 'Damodar City, Suva','Suva Municipal Market, Suva'],
           'Bua'       => ['Dummy1 address, 123, Bua','Dummy2 address, 123, Bua','Dummy3 address, 123, Bua','Dummy4 address, 123, Bua'],
           'Seaqaqa'   => ['Dummy1 address, 123, Seaqaqa','Dummy2 address, 123, Seaqaqa','Dummy3 address, 123, Seaqaqa','Dummy4 address, 123, Seaqaqa'],
           'Savusavu'  => ['Dummy1 address, 123, Seaqaqa','Dummy2 address, 123, Seaqaqa','Dummy3 address, 123, Seaqaqa','Dummy4 address, 123, Seaqaqa'],
           'Labasa'    => ['Dummy1 address, 123, Labasa','Dummy2 address, 123, Labasa','Dummy3 address, 123, Labasa','Dummy4 address, 123, Labasa'],
           'Taveuni'   => ['Dummy1 address, 123, Taveuni','Dummy2 address, 123, Taveuni','Dummy3 address, 123, Taveuni','Dummy4 address, 123, Taveuni'],
           'Rabi'      => ['Dummy1 address, 123, Rabi','Dummy2 address, 123, Rabi','Dummy3 address, 123, Rabi','Dummy4 address, 123, Rabi'],
           'Sigatoka'  => ['Dummy1 address, 123, Sigatoka','Dummy2 address, 123, Sigatoka','Dummy3 address, 123, Sigatoka','Dummy4 address, 123, Sigatoka'],
           'Nadi'      => ['Dummy1 address, 123, Nadi','Dummy2 address, 123, Nadi','Dummy3 address, 123, Nadi','Dummy4 address, 123, Nadi'],
           'Lautoka'   => ['Dummy1 address, 123, Lautoka','Dummy2 address, 123, Lautoka','Dummy3 address, 123, Lautoka','Dummy4 address, 123, Lautoka'],
           'Ba'        => ['Dummy1 address, 123, Ba','Dummy2 address, 123, Ba','Dummy3 address, 123, Ba','Dummy4 address, 123, Ba'],
           'Tavua'     => ['Dummy1 address, 123, Tavua','Dummy2 address, 123, Tavua','Dummy3 address, 123, Tavua','Dummy4 address, 123, Tavua'],
           'Rakiraki'  => ['Dummy1 address, 123, Rakiraki','Dummy2 address, 123, Rakiraki','Dummy3 address, 123, Rakiraki','Dummy4 address, 123, Rakiraki'],
           'Nalawa'    => ['Dummy1 address, 123, Nalawa','Dummy2 address, 123, Nalawa','Dummy3 address, 123, Nalawa','Dummy4 address, 123, Nalawa'],
        ];

        for ($i = 0; $i < 30; $i++) {

            $firstname  =  $faker->firstname();
            $lastname   = $faker->lastname();
            $email      = $i == 0 ? 'volunteer@redcross.com' : $faker->unique()->safeEmail();
            $phone      = $faker->numerify('7#9#8#2####');
            $division   = $faker->randomElement(['Central / Eastern', 'Northern', 'Western']);
            switch ($division) {
                case 'Central / Eastern':
                    $registration_location_type = $faker->randomElement(['Rotuma', 'Levuka', 'Suva']);
                    break;

                case 'Northern':
                    $registration_location_type = $faker->randomElement(['Bua', 'Seaqaqa', 'Savusavu', 'Labasa', 'Taveuni', 'Rabi']);
                    break;

                case 'Western':
                    $registration_location_type = $faker->randomElement(['Sigatoka', 'Nadi', 'Lautoka', 'Ba', 'Tavua', 'Rakiraki', 'Nalawa']);
                    break;

                default:
                    $registration_location_type = $faker->randomElement(['Rotuma', 'Levuka', 'Suva', 'Bua', 'Seaqaqa', 'Savusavu', 'Labasa', 'Taveuni', 'Rabi', 'Sigatoka', 'Nadi', 'Lautoka', 'Ba', 'Tavua', 'Rakiraki', 'Nalawa']);
                    break;
            }

            

            $user = User::create([
                'firstname'         => $firstname,
                'lastname'          => $lastname,
                'email'             => $email,
                'email_verified_at' => now(),
                'status'            => $i <= 10 ? 'approve' : 'pending',
                'approved_by'       => $i <= 10 ? 'HQ' : null,
                'phone'             => $phone,
                'password'          => Hash::make('password'),
                'role'              => $faker->randomElement(['volunteer', 'member', 'both']),
                'branch'            => $registration_location_type,
                'expiry_date'       => $faker->randomElement([Carbon::now()->addDays(14)->format('Y-m-d'), Carbon::now()->addDays(15)->format('Y-m-d'), Carbon::now()->addDays(13)->format('Y-m-d')]),

            ]);


            LodgementInformation::create([
                'user_id'                    => $user->id,
                'date_of_lodgement'          => $faker->randomElement([Carbon::now()->subDays(2)->format('Y-m-d'), Carbon::now()->subDays(3)->format('Y-m-d'), Carbon::now()->subDays(4)->format('Y-m-d')]),
                'registering_year'           => '2023',
                'division'                   => $division,
                'registration_location'      => $faker->randomElement(['West, 1 Vomo St, Lautoka', 'North, Lot 24 Tuatua, Labasa', '22 Gorrie St., Suva, Fiji']),
                'registration_location_type' => $registration_location_type,
            ]);

            PersonalInformation::create([
                'user_id'                       => $user->id,
                'lastname'                      => $lastname,
                'firstname'                     => $firstname,
                'other_names'                   => $faker->name(),
                'father_name'                   => $faker->name(),
                'date_of_birth'                 => Carbon::now()->subYears(30)->format('Y-m-d'),
                'sex'                           => $faker->randomElement(['Male', 'Female', 'Non-Binary']),
                'citizenship'                   => $faker->randomElement(['Fiji', 'Other']),
                'specify_citizenship'           => $faker->randomElement(['Indian', 'Chinese']),
                'ethnic_background'             => ['Itaukei', 'Indo Fijian', 'Rotuman', 'Other', 'Banaban'],
                'specify_ethnic_background'     => $faker->randomElement(['Indian Ethnicity', 'Chinese Ethnicity']),
                'marital_status'                => $faker->randomElement(['Married', 'Single / Never Married', 'Divorced', 'Widowed', 'Partner / Defacto', 'Prefer not to say']),
                'no_of_dependents'              => $faker->randomElement(['4', '5', '6']),
                'languages_spoken'              => ['English', 'Hindi', 'Other Languages', 'Urdu', 'Banaban'],
                'specify_languages_spoken'      =>  $faker->randomElement(['Chinese', 'Hebrew', 'Other']),
            ]);

            $adr = $faker->randomElement($address[$registration_location_type]);

            $contact_data                                       = array();
            $contact_data['user_id']                            = $user->id;
            $contact_data['resedential_address']                = $adr;
            $contact_data['community_name']                     = 'Fijians';
            $contact_data['community_type']                     = $faker->randomElement(['Village', 'Settlement', 'Compound']);
            $contact_data['province']                           = $faker->randomElement(['Tailevu', 'Rewa', 'Namosi', 'Lau', 'Serua']);
            $contact_data['district']                           = $faker->randomElement(['Cakaudrove', 'Naitasiri', 'Lautoka', 'Macuata', 'Ra Province']);
            $contact_data['postal_address']                     = $adr;
            $contact_data['email']                              = $email;
            $contact_data['landline_contact']                   = $faker->numerify('7#9#8#2###');
            $contact_data['primary_mobile_contact_number']      = $faker->numerify('7#9#8#2###');
            $contact_data['primary_mobile_network_provider']    = $faker->randomElement(['Vodafone', 'Inkk', 'Digicel']);
            $contact_data['other_contact_numbers']              = $faker->numerify('7#9#8#2###');
            $contact_data['full_name_of_emergency_contact']     = $faker->name();
            $contact_data['relationship']                       = $faker->randomElement(['Son', 'Father', 'Uncle']);
            $contact_data['resedential_address_separate']       = $adr;
            $contact_data['contact_number']                     = $faker->numerify('7#9#8#2###');

            ContactInformation::create($contact_data);

            $identification_data                                       = array();
            $identification_data['user_id']                            = $user->id;
            $identification_data['photo_id_card_type']                 = 'Other';
            $identification_data['specify_photo_id_card_type']         = 'Passport';
            $identification_data['id_card_number']                     = $faker->numerify('26##-7#2#-#3##');
            $identification_data['id_expiry_date']                     = Carbon::now()->addYears(7)->format('Y-m-d');
            $identification_data['tin']                                = $faker->numerify('##-#####-#-#');
            $identification_data['photo_id']                           = 'photo_id.png';

            ValidNationalIdentification::create($identification_data);

            $employment_data                                       = array();
            $employment_data['user_id']                            = $user->id;
            $employment_data['current_employment_status']          = $faker->randomElement(['Employed', 'Self-Employed']);
            $employment_data['current_occupation']                 = $faker->randomElement(['Web Developer', 'Web Designer']);
            $employment_data['organisation_name']                  = $faker->company();
            $employment_data['organisation_address']               = $faker->address();
            $employment_data['work_contact_number']                = $faker->numerify('7#9#8#2###');

            EmploymentDetail::create($employment_data);

            $education_background_data                                       = array();
            $education_background_data['user_id']                            = $user->id;
            $education_background_data['highest_level_of_education']         = $faker->randomElement(['Doctorate', 'Degree', 'Certificate', 'Masters', 'Diploma']);
            EducationBackground::create($education_background_data);

            for ($j = 1; $j < 3; $j++) {
                $qual                  = new Qualification();
                $qual->user_id         = $user->id;
                $qual->year            = Carbon::now()->subYears($j + 3)->format('Y');
                $qual->institution     = $faker->randomElement(['Fiji National University', 'The University of the South Pacific']);
                $qual->course          = $j == 1 ? 'Business Administration' : $faker->randomElement(['B.Sc', 'B.Com', 'B.Arts', 'B.Ed']);
                $qual->course_status   = 'Complete';
                $qual->evidence        = $j . '.png';
                $qual->save();
            }

            for ($k = 1; $k < 3; $k++) {
                $skil                  = new Skill();
                $skil->user_id         = $user->id;
                $skil->skill           = $k == 1 ? 'React Native' : $faker->randomElement(['Wordpress', 'Laravel']);
                $skil->evidence        = $k . '.png';
                $skil->save();
            }

            $special_information_data                                       = array();
            $special_information_data['user_id']                            = $user->id;
            $special_information_data['any_police_records']                 = $faker->randomElement(['Yes', 'No']);
            $special_information_data['any_special_needs']                  = $faker->randomElement(['Yes', 'No']);
            $special_information_data['specify_special_needs']              = $special_information_data['any_special_needs'] == 'Yes' ? 'Wheelchair needed' : null;
            $special_information_data['any_medical_conditions']             = $faker->randomElement(['Yes', 'No']);
            $special_information_data['specify_medical_conditions']         = $special_information_data['any_medical_conditions'] == 'Yes' ? $faker->randomElement(['Asthama', 'Bronchitis']) : null;
            $special_information_data['know_how_to_swim']                   = $faker->randomElement(['Yes', 'No']);
            $special_information_data['full_covid_vaccination']             = $faker->randomElement(['Yes', 'No']);
            $special_information_data['date_first_vaccine']                 = Carbon::now()->subYears(3)->format('Y-m-d');;
            $special_information_data['date_second_vaccine']                = Carbon::now()->subYears(2)->format('Y-m-d');;
            $special_information_data['date_booster']                       = Carbon::now()->subYears(1)->format('Y-m-d');;

            SpecialInformation::create($special_information_data);


            $blood_information_data                                       = array();
            $blood_information_data['user_id']                            = $user->id;
            $blood_information_data['blood_donar']                        = $faker->randomElement(['Yes', 'No']);
            $blood_information_data['know_your_blood_group']              = $faker->randomElement(['Yes', 'No']);
            $blood_information_data['blood_group']                        = $faker->randomElement(['A+', 'A-', 'B+', 'O+']);

            BloodInformation::create($blood_information_data);

            for ($l = 1; $l < 3; $l++) {
                $volun                               = new VolunteeringInformation();
                $volun->user_id                      = $user->id;
                $volun->year                         = Carbon::now()->subYears($l + 3)->format('Y');
                $volun->experience                   = $faker->randomElement(['1 Year', '2  Years', '3 Months', '1 Week']);
                $volun->red_cross_involvement        = $faker->randomElement(['Yes', 'No']);
                $volun->save();
            }

            $service_interest_data                                       = array();
            $service_interest_data['user_id']                            = $user->id;
            $service_interest_data['service_interest']                   = ["Marketing", "Communications", "Safety", "Administration", "Legal", "Accounting"];
            $service_interest_data['available_days']                     = ["Monday", "Wednesday", "Friday", "Sunday"];
            $service_interest_data['available_times']                    = ["Morning: 06:00 AM to 10:00 AM", "Midday: 10:00 AM to 02:00 PM", "Mid-afternoon: 02:00 PM to 06:00 PM"];
            $service_interest_data['other_skills']                       = $faker->randomElement(['Driving', 'Teaching', 'Health Aid', 'Nurturing']);

            ServiceInterest::create($service_interest_data);

            $personal_banking_data                                       = array();
            $personal_banking_data['user_id']                            = $user->id;
            $personal_banking_data['bank']                                   = $faker->randomElement(['Bank of South Pacific (BSP)', 'Australia & New Zealand Banking Group (ANZ)', 'Home Finance Company Bank (HFC)', 'Westpac']);
            $personal_banking_data['account_number']                         = $faker->numerify('4988###1###20###');
            $personal_banking_data['name_bank_account']                      = $firstname . ' ' . $lastname;
            PersonalBankingInformation::create($personal_banking_data);

            $mobile_banking_data                                       = array();
            $mobile_banking_data['user_id']                            = $user->id;
            $mobile_banking_data['mobile_bank']                        = $faker->randomElement(['Vodafone MPAISA', 'Digicel MyCash']);
            $mobile_banking_data['mobile_bank_number']                 = $phone;
            $mobile_banking_data['name_mobile_bank_account']           = $firstname . ' ' . $lastname;
            MobileBankingInformation::updateOrCreate($mobile_banking_data);

            for ($m = 1; $m < 3; $m++) {
                $refr                  = new RefereeInformation();
                $refr->user_id         = $user->id;
                $refr->name            = $faker->name();
                $refr->role            = $faker->randomElement(['Volunteer', 'Administrator']);
                $refr->organisation    = "Red Cross Society";
                $refr->contact_number  = $faker->numerify('9988###1#0');
                $refr->email           = $faker->email;
                $refr->save();
            }

            $consent_data                                             = array();
            $consent_data['user_id']                                  = $user->id;
            $consent_data['consent_to_be_contacted']                  = $faker->randomElement(['Yes', 'No']);
            $consent_data['consent_to_background_check']              = $faker->randomElement(['Yes', 'No']);
            $consent_data['parental_consent']                         = $faker->randomElement(['Yes', 'No']);
            $consent_data['media_consent']                            = $faker->randomElement(['Yes', 'No']);
            $consent_data['agree_to_code_of_conduct']                 = $faker->randomElement(['Yes', 'No']);
            $consent_data['agree_to_child_protection_policy']         = $faker->randomElement(['Yes', 'No']);
            $consent_data['age_under_18']                            = $faker->randomElement(['Yes', 'No']);
            Consent::create($consent_data);

            $check_data                                             = array();
            $check_data['user_id']                                  = $user->id;
            $check_data['statutory_declaration_attached']           = $faker->randomElement(['Yes', 'No']);
            $check_data['statutory_declaration']                    = '1.png';
            $check_data['code_of_conduct_attached']                 = $faker->randomElement(['Yes', 'No']);
            $check_data['code_of_conduct']                          = '2.png';
            $check_data['signed_child_protection_policy_attached']  = $faker->randomElement(['Yes', 'No']);
            $check_data['signed_child_protection_policy']           = '3.png';
            $check_data['professional_volunteer']                   = $faker->randomElement(['Yes', 'No']);
            $check_data['professional_volunteer_attachment']        = '4.png';
            $check_data['base_location']                            = $faker->randomElement(['Branch', 'Office']);
            Check::create($check_data);
        }


        for ($i = 0; $i < 5; $i++) {

            $community = CommunityActivity::create([

                'name'      => 'Community Activity ' . $i + 1,
                'breif'     => '<h2 style="margin: 0px 0px 10px; padding: 0px; font-weight: 400; font-family: DauphinPlain; font-size: 24px; line-height: 24px;">What is Lorem Ipsum?</h2> <p style="margin: 0px 0px 15px; padding: 0px; text-align: justify; font-family: \'Open Sans\', Arial, sans-serif; font-size: 14px;"><strong style="margin: 0px; padding: 0px;">Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
                'submit_by' =>  4,
                'submit_to' =>  3,
                'status'    =>  ($i < 2) ? 'Approved' : 'Pending' 

            ]);


            for ($a = 0; $a <= 3; $a++) {

                CommunityAttendees::create([
                    'community_id' => $community->id,
                    'attendee_id'  =>  $a+2,
                ]);

                CommunityAttendence::create([
                    'email' => User::find( $a+2 )->email,
                    'date'  => Carbon::now()->format('d-m-Y'),
                    'activity_id' => $community->id,
                    'added_by' => 1,
                ]);

                CommunityDocs::create([
                    'community_id' => $community->id,
                    'type'         => 'image',
                    'doc'          => $faker->randomElement(['1.jpeg', '2.jpg', '3.jpg', '4.jpg', '5.jpeg']),
                ]);

                CommunityDocs::create([
                    'community_id' => $community->id,
                    'type'         => 'doc',
                    'doc'          => $faker->randomElement(['doc1.xlsx', 'doc2.xlsx', 'doc3.xlsx', 'doc4.pdf']),
                ]);
            }
        }

        $active = User::where('status','approve')->take(20)->get();
        
        if( count($active) > 0 ){
            foreach( $active as $user){
                 
                UserHours::create([

                    'email'     => $user->email,
                    'date'      => $faker->randomElement([Carbon::now()->addDay(1)->format('d-m-Y'), Carbon::now()->addDay(2)->format('d-m-Y'), Carbon::now()->addDay(3)->format('d-m-Y')]),
                    'start_time'=> $faker->randomElement(['10:00:00 AM','11:00:00 AM']),
                    'end_time'  => $faker->randomElement(['02:00:00 PM','03:00:00 PM']),
                    'comment'   => $faker->randomElement(['Helping orphans','Helping Adminstartive work',' Take part in blood donation camp']),
                ]);
            }
        }
    }
}
