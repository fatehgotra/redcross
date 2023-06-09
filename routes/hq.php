<?php

use App\Http\Controllers\Hq\Auth\ChangePasswordController;
use App\Http\Controllers\Hq\Auth\ForgotPasswordController;
use App\Http\Controllers\Hq\Auth\LoginController;
use App\Http\Controllers\Hq\Auth\MyAccountController;
use App\Http\Controllers\Hq\Auth\ResetPasswordController;
use App\Http\Controllers\Hq\DashboardController;
use App\Http\Controllers\Hq\UserController;
use App\Http\Controllers\Hq\VolunteerDetailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'hq', 'as' => 'hq.'], function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes | LOGIN | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/update', [ResetPasswordController::class, 'reset'])->name('password.update');


    /*
    |--------------------------------------------------------------------------
    | Dashboard Route
    |--------------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Users Route
    |--------------------------------------------------------------------------
    */

    Route::resource('volunteers', UserController::class);

    Route::get('volunteer/approval-history/{id}', [UserController::class, 'approvalHistory'])->name('volunteer.approval-history');

    Route::post('volunteer/reset-password', [UserController::class, 'resetPassword'])->name('volunteer.reset-password');

    /* Volunteer Information > Lodge Information (Tab 1)*/
    Route::get('volunteer/lodge-information/{id}', [VolunteerDetailController::class, 'lodgeInformationForm'])->name('volunteer-detail.lodge-information.form');

    /* Volunteer Information > Personal Information (Tab 2)*/
    Route::get('volunteer/personal-information/{id}', [VolunteerDetailController::class, 'personalInformationForm'])->name('volunteer-detail.personal-information.form');

    /* Volunteer Information > Contact Information (Tab 3)*/
    Route::get('volunteer/contact-information/{id}', [VolunteerDetailController::class, 'contactInformationForm'])->name('volunteer-detail.contact-information.form');

    /* Volunteer Information > Contact Information (Tab 4)*/
    Route::get('volunteer/identification-and-employement-details/{id}', [VolunteerDetailController::class, 'identificationAndEmployementDetailsForm'])->name('volunteer-detail.identification-and-employement-details.form');

    /* Volunteer Information > Education Background (Tab 5)*/
    Route::get('volunteer/education-background/{id}', [VolunteerDetailController::class, 'educationBackgroundForm'])->name('volunteer-detail.education-background.form');

    /* Volunteer Information > Special Information (Tab 6)*/
    Route::get('volunteer/special-information/{id}', [VolunteerDetailController::class, 'specialInformationForm'])->name('volunteer-detail.special-information.form');

    /* Volunteer Information > Service Interest (Tab 7)*/
    Route::get('volunteer/service-interest/{id}', [VolunteerDetailController::class, 'serviceInterestForm'])->name('volunteer-detail.service-interest.form');

    /* Volunteer Information > Banking Information (Tab 8)*/
    Route::get('volunteer/banking-information/{id}', [VolunteerDetailController::class, 'bankingInformationForm'])->name('volunteer-detail.banking-information.form');

    /* Volunteer Information > Consent and checks (Tab 9)*/
    Route::get('volunteer/consents-and-checks/{id}', [VolunteerDetailController::class, 'consentsAndChecksForm'])->name('volunteer-detail.consents-and-checks.form');   

    Route::put('volunteer/change-status/{id}', [UserController::class, 'changeStatus'])->name('change-status');

    /*
    |--------------------------------------------------------------------------
    | Settings > My Account Route
    |--------------------------------------------------------------------------
    */
    Route::resource('my-account', MyAccountController::class);

    /*
    |--------------------------------------------------------------------------
    | Settings > Change Password Route
    |--------------------------------------------------------------------------
    */
    Route::get('change-password', [ChangePasswordController::class, 'changePasswordForm'])->name('password.form');

    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
});
