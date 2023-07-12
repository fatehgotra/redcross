<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AlertController;
use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\MyAccountController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CourseDocumentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Learning\CourseController;
use App\Http\Controllers\Admin\Learning\QuestionController;
use App\Http\Controllers\Admin\Learning\VideoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VolunteerDetailController;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

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
    | User Management Route
    |--------------------------------------------------------------------------
    */


    Route::resource('user-management/admins', AdminController::class, [
        'names' => [
            'index'         => 'admins.index',
            'create'        => 'admins.create',
            'update'        => 'admins.update',
            'edit'          => 'admins.edit',
            'store'         => 'admins.store',
            'show'          => 'admins.show',
            'destroy'       => 'admins.destroy',
        ]
    ]);

    Route::post('admins/reset-password', [AdminController::class, 'resetPassword'])->name('admins.reset-password');

    /*
    |--------------------------------------------------------------------------
    | Courses Route
    |--------------------------------------------------------------------------
    */


    Route::resource('learning/courses', CourseController::class, [
        'names' => [
            'index'         => 'courses.index',
            'create'        => 'courses.create',
            'update'        => 'courses.update',
            'edit'          => 'courses.edit',
            'store'         => 'courses.store',
            'show'          => 'courses.show',
            'destroy'       => 'courses.destroy',
        ]
    ]);

    /*
    |--------------------------------------------------------------------------
    | Course Documents Route
    |--------------------------------------------------------------------------
    */


    Route::resource('learning/course-documents', CourseDocumentController::class, [
        'names' => [
            'index'         => 'course-documents.index',
            'create'        => 'course-documents.create',
            'update'        => 'course-documents.update',
            'edit'          => 'course-documents.edit',
            'store'         => 'course-documents.store',
            'show'          => 'course-documents.show',
            'destroy'       => 'course-documents.destroy',
        ]
    ]);

     /*
    |--------------------------------------------------------------------------
    | Questions Route
    |--------------------------------------------------------------------------
    */


    Route::resource('learning/mcqs', QuestionController::class, [
        'names' => [
            'index'         => 'mcqs.index',
            'create'        => 'mcqs.create',
            'update'        => 'mcqs.update',
            'edit'          => 'mcqs.edit',
            'store'         => 'mcqs.store',
            'show'          => 'mcqs.show',
            'destroy'       => 'mcqs.destroy',
        ]
    ]);

     /*
    |--------------------------------------------------------------------------
    | Videos Route
    |--------------------------------------------------------------------------
    */


    Route::resource('learning/videos', VideoController::class, [
        'names' => [
            'index'         => 'videos.index',
            'create'        => 'videos.create',
            'update'        => 'videos.update',
            'edit'          => 'videos.edit',
            'store'         => 'videos.store',
            'show'          => 'videos.show',
            'destroy'       => 'videos.destroy',
        ]
    ]);


    /*
    |--------------------------------------------------------------------------
    | Volunteers Route
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

    /*
    |--------------------------------------------------------------------------
    | Alerts Route
    |--------------------------------------------------------------------------
    */

    Route::resource('alerts', AlertController::class);

    /*
    |--------------------------------------------------------------------------
    | Updates Route
    |--------------------------------------------------------------------------
    */

    Route::resource('updates', BlogController::class);

    /*
    |--------------------------------------------------------------------------
    | Campaigns Route
    |--------------------------------------------------------------------------
    */

    Route::resource('campaigns', CampaignController::class);

    Route::put('campaign/mark-attendence/{id}', [CampaignController::class, 'markAttendance'])->name('mark.attendance');


});
