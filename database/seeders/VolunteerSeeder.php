<?php

namespace Database\Seeders;

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
use App\Models\User;
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
                'phone'             => $phone,
                'password'          => Hash::make('password'),
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

            $contact_data                                       = array();
            $contact_data['user_id']                            = $user->id;
            $contact_data['resedential_address']                = $faker->address();
            $contact_data['community_name']                     = 'Fijians';
            $contact_data['community_type']                     = $faker->randomElement(['Village', 'Settlement', 'Compound']);
            $contact_data['province']                           = $faker->randomElement(['Tailevu', 'Rewa', 'Namosi', 'Lau', 'Serua']);
            $contact_data['district']                           = $faker->randomElement(['Cakaudrove', 'Naitasiri', 'Lautoka', 'Macuata', 'Ra Province']);
            $contact_data['postal_address']                     = $faker->address();
            $contact_data['email']                              = $email;
            $contact_data['landline_contact']                   = $faker->numerify('7#9#8#2###');
            $contact_data['primary_mobile_contact_number']      = $faker->numerify('7#9#8#2###');
            $contact_data['primary_mobile_network_provider']    = $faker->randomElement(['Vodafone', 'Inkk', 'Digicel']);
            $contact_data['other_contact_numbers']              = $faker->numerify('7#9#8#2###');
            $contact_data['full_name_of_emergency_contact']     = $faker->name();
            $contact_data['relationship']                       = $faker->randomElement(['Son', 'Father', 'Uncle']);
            $contact_data['resedential_address_separate']       = $faker->address();
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
            $check_data['code_of_conduct_attached']                 = $faker->randomElement(['Yes', 'No']);
            $check_data['signed_child_protection_policy_attached']  = $faker->randomElement(['Yes', 'No']);
            $check_data['professional_volunteer']                              = $faker->randomElement(['Yes', 'No']);
            $check_data['base_location']                            = $faker->randomElement(['Branch', 'Office']);
            Check::create($check_data);
        }
    }
}
