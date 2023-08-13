<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Learning\CourseController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\MyAccountController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSkuController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/payment-details', function () {
    return view('payment-detail');
})->name('payment-details');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


/* Settings > My Account Route */
Route::resource('my-account', MyAccountController::class);

/* Settings > Change Password Route */
Route::get('change-password', [ChangePasswordController::class, 'changePasswordForm'])->name('password.form');

Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');

/* Volunteer Registration Lodge Information (Tab 1)*/
Route::get('volunteer-registration/lodge-information', [VolunteerController::class, 'lodgeInformationForm'])->name('lodge-information.form');
Route::post('volunteer-registration/lodge-information', [VolunteerController::class, 'lodgeInformation'])->name('lodge-information');

/* Volunteer Registration Personal Information (Tab 2)*/
Route::get('volunteer-registration/personal-information', [VolunteerController::class, 'personalInformationForm'])->name('personal-information.form');
Route::post('volunteer-registration/personal-information', [VolunteerController::class, 'personalInformation'])->name('personal-information');

/* Volunteer Registration Contact Information (Tab 3)*/
Route::get('volunteer-registration/contact-information', [VolunteerController::class, 'contactInformationForm'])->name('contact-information.form');
Route::post('volunteer-registration/contact-information', [VolunteerController::class, 'contactInformation'])->name('contact-information');

/* Volunteer Registration Contact Information (Tab 4)*/
Route::get('volunteer-registration/identification-and-employement-details', [VolunteerController::class, 'identificationAndEmployementDetailsForm'])->name('identification-and-employement-details.form');
Route::post('volunteer-registration/identification-and-employement-details', [VolunteerController::class, 'identificationAndEmployementDetails'])->name('identification-and-employement-details');

/* Volunteer Registration Education Background (Tab 5)*/
Route::get('volunteer-registration/education-background', [VolunteerController::class, 'educationBackgroundForm'])->name('education-background.form');
Route::post('volunteer-registration/education-background', [VolunteerController::class, 'educationBackground'])->name('education-background');

/* Volunteer Registration Special Information (Tab 6)*/
Route::get('volunteer-registration/special-information', [VolunteerController::class, 'specialInformationForm'])->name('special-information.form');
Route::post('volunteer-registration/special-information', [VolunteerController::class, 'specialInformation'])->name('special-information');

/* Volunteer Registration Service Interest (Tab 7)*/
Route::get('volunteer-registration/service-interest', [VolunteerController::class, 'serviceInterestForm'])->name('service-interest.form');
Route::post('volunteer-registration/service-interest', [VolunteerController::class, 'serviceInterest'])->name('service-interest');

/* Volunteer Registration Banking Information (Tab 8)*/
Route::get('volunteer-registration/banking-information', [VolunteerController::class, 'bankingInformationForm'])->name('banking-information.form');
Route::post('volunteer-registration/banking-information', [VolunteerController::class, 'bankingInformation'])->name('banking-information');

/* Volunteer Registration Consent and checks (Tab 9)*/
Route::get('volunteer-registration/consents-and-checks', [VolunteerController::class, 'consentsAndChecksForm'])->name('consents-and-checks.form');
Route::post('volunteer-registration/consents-and-checks', [VolunteerController::class, 'consentsAndChecks'])->name('consents-and-checks');

/*
|--------------------------------------------------------------------------
| User Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/* My Profile > Lodge Information (Tab 1)*/
Route::get('my-profile/lodge-information', [MyProfileController::class, 'lodgeInformationForm'])->name('my-profile.lodge-information.form');
Route::post('my-profile/lodge-information', [MyProfileController::class, 'lodgeInformation'])->name('my-profile.lodge-information');

/* My Profile > Personal Information (Tab 2)*/
Route::get('my-profile/personal-information', [MyProfileController::class, 'personalInformationForm'])->name('my-profile.personal-information.form');
Route::post('my-profile/personal-information', [MyProfileController::class, 'personalInformation'])->name('my-profile.personal-information');

/* My Profile > Contact Information (Tab 3)*/
Route::get('my-profile/contact-information', [MyProfileController::class, 'contactInformationForm'])->name('my-profile.contact-information.form');
Route::post('my-profile/contact-information', [MyProfileController::class, 'contactInformation'])->name('my-profile.contact-information');

/* My Profile > Contact Information (Tab 4)*/
Route::get('my-profile/identification-and-employement-details', [MyProfileController::class, 'identificationAndEmployementDetailsForm'])->name('my-profile.identification-and-employement-details.form');
Route::post('my-profile/identification-and-employement-details', [MyProfileController::class, 'identificationAndEmployementDetails'])->name('my-profile.identification-and-employement-details');

/* My Profile > Education Background (Tab 5)*/
Route::get('my-profile/education-background', [MyProfileController::class, 'educationBackgroundForm'])->name('my-profile.education-background.form');
Route::post('my-profile/education-background', [MyProfileController::class, 'educationBackground'])->name('my-profile.education-background');

/* My Profile > Special Information (Tab 6)*/
Route::get('my-profile/special-information', [MyProfileController::class, 'specialInformationForm'])->name('my-profile.special-information.form');
Route::post('my-profile/special-information', [MyProfileController::class, 'specialInformation'])->name('my-profile.special-information');

/* My Profile > Service Interest (Tab 7)*/
Route::get('my-profile/service-interest', [MyProfileController::class, 'serviceInterestForm'])->name('my-profile.service-interest.form');
Route::post('my-profile/service-interest', [MyProfileController::class, 'serviceInterest'])->name('my-profile.service-interest');

/* My Profile > Banking Information (Tab 8)*/
Route::get('my-profile/banking-information', [MyProfileController::class, 'bankingInformationForm'])->name('my-profile.banking-information.form');
Route::post('my-profile/banking-information', [MyProfileController::class, 'bankingInformation'])->name('my-profile.banking-information');

/* My Profile > Consent and checks (Tab 9)*/
Route::get('my-profile/consents-and-checks', [MyProfileController::class, 'consentsAndChecksForm'])->name('my-profile.consents-and-checks.form');
Route::post('my-profile/consents-and-checks', [MyProfileController::class, 'consentsAndChecks'])->name('my-profile.consents-and-checks');

/* Learning Routes */
Route::get('learning/courses', [LearningController::class, 'courses'])->name('learning.courses');

/* Get Test Route */
Route::get('learning/courses/take-test/{id}', [LearningController::class, 'takeTest'])->name('learning.take-test');

/* Exit Test Route */
Route::put('learning/courses/exit-test/{id}', [LearningController::class, 'exitTest'])->name('learning.exit-test');

/* Document Route */
Route::get('learning/courses/documents/{id}', [LearningController::class, 'documents'])->name('learning.documents');

/* Submit Test Route */
Route::put('learning/courses/take-test/{id}', [LearningController::class, 'submitTest'])->name('learning.submit-test');

/* Get All Videos Routes */
Route::get('learning/courses/watch-videos/{id}', [LearningController::class, 'videos'])->name('learning.watch-videos');

/* Get Test Result Routes */
Route::get('learning/results/{id}', [LearningController::class, 'result'])->name('learning.result');


/* Get Alerts Routes */
Route::get('alerts', [AlertController::class, 'index'])->name('alerts.index');

/* Get Updates Routes */
Route::get('updates', [UpdateController::class, 'index'])->name('updates.index');

/* Get Campaigns Routes */
Route::get('campaigns', [CampaignController::class, 'index'])->name('campaigns.index');

/* Join Campaign Route */
Route::put('campaigns/join/{id}', [CampaignController::class, 'join'])->name('join.campaign');

/* Leave Campaign Route */
Route::put('campaigns/leave/{id}', [CampaignController::class, 'leave'])->name('leave.campaign');

/* ExpirySchedule */
Route::get('/expiry-schedule', function () {
    Artisan::call('send:membership-notification');
        return response()->json(['success', 'All members whose membership will expire in the next 14 days are notified.'], 200);
})->name('expiry-schedule');

//certificate
Route::get('certificate/{id}/{course_id}/{attempt}',[CourseController::class,'certificate'])->name('certificate');
Route::get('user-survey/{id}/{uid}',[VolunteerController::class,'userSurvey'])->name('user-survey');
Route::post('submit-survey',[VolunteerController::class,'submitSurvey'])->name('submit-survey');