<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\MyAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSkuController;
use App\Http\Controllers\VolunteerController;
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

Auth::routes(["verify" => true]);

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