<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminSurveysController;
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
use App\Http\Controllers\Admin\MappingController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MemberDetailController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VolunteerDetailController;
use App\Http\Controllers\Admin\AdminCourseChatController;
use App\Http\Controllers\Admin\ChatController;
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
    | Members Route
    |--------------------------------------------------------------------------
    */

    Route::resource('members', MemberController::class);

    Route::get('member/approval-history/{id}', [MemberController::class, 'approvalHistory'])->name('member.approval-history');

    Route::post('member/reset-password', [MemberController::class, 'resetPassword'])->name('member.reset-password');

    Route::get('member-expiry/{id}', [MemberController::class, 'showExpiryForm'])->name('members.expiry');

    Route::put('member/expiry/{id}', [MemberController::class, 'updateExpiry'])->name('members.expiry-update');

    /* Member Information > Lodge Information (Tab 1)*/
    Route::get('member/lodge-information/{id}', [MemberDetailController::class, 'lodgeInformationForm'])->name('member-detail.lodge-information.form');

    /* Member Information > Personal Information (Tab 2)*/
    Route::get('member/personal-information/{id}', [MemberDetailController::class, 'personalInformationForm'])->name('member-detail.personal-information.form');

    /* Member Information > Contact Information (Tab 3)*/
    Route::get('member/contact-information/{id}', [MemberDetailController::class, 'contactInformationForm'])->name('member-detail.contact-information.form');

    /* Member Information > Contact Information (Tab 4)*/
    Route::get('member/identification-and-employement-details/{id}', [MemberDetailController::class, 'identificationAndEmployementDetailsForm'])->name('member-detail.identification-and-employement-details.form');

    /* Member Information > Education Background (Tab 5)*/
    Route::get('member/education-background/{id}', [MemberDetailController::class, 'educationBackgroundForm'])->name('member-detail.education-background.form');

    /* Member Information > Special Information (Tab 6)*/
    Route::get('member/special-information/{id}', [MemberDetailController::class, 'specialInformationForm'])->name('member-detail.special-information.form');

    /* Member Information > Service Interest (Tab 7)*/
    Route::get('member/service-interest/{id}', [MemberDetailController::class, 'serviceInterestForm'])->name('member-detail.service-interest.form');

    /* Member Information > Banking Information (Tab 8)*/
    Route::get('member/banking-information/{id}', [MemberDetailController::class, 'bankingInformationForm'])->name('member-detail.banking-information.form');

    /* Member Information > Consent and checks (Tab 9)*/
    Route::get('member/consents-and-checks/{id}', [MemberDetailController::class, 'consentsAndChecksForm'])->name('member-detail.consents-and-checks.form');

    Route::put('member/change-status/{id}', [MemberController::class, 'changeStatus'])->name('member.change-status');

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

    Route::post('campagin-user',[CampaignController::class,'campaginUserAdd'])->name('campagin-user');

    Route::post('campagin-user-new',[CampaignController::class,'campaginNewUserAdd'])->name('campagin-user-new');

    Route::post('flag',[CampaignController::class,'AddFlag'])->name('flag');

    Route::get('community',[CampaignController::class,'community'])->name('community');

    Route::get('community-activity',[CampaignController::class,'communityActivity'])->name('community-activity');

    Route::post('community-store',[CampaignController::class,'communityStore'])->name('community-store');

    Route::get('view-activity/{id}',[CampaignController::class,'viewActivity'])->name('view-activity');

    Route::post('approve-activity/{id}',[CampaignController::class,'approve'])->name('approve-activity');

    Route::get('community-attendence/{id}',[CampaignController::class,'showAttendence'])->name('community-attendence');

    Route::put('community/mark-attendence/{id}', [CampaignController::class, 'markCommunityAttendance'])->name('mark.community-attendance');

     /*
    |--------------------------------------------------------------------------
    | Survey Route
    |--------------------------------------------------------------------------
    */

    Route::get('survey-forms',[AdminSurveysController::class,'index'])->name('survey-forms');
    Route::get('survey',[AdminSurveysController::class,'survey'])->name('survey');
    Route::post('add-survey',[AdminSurveysController::class,'addSurvey'])->name('add-survey');
    Route::get('view-survey/{id}',[AdminSurveysController::class,'viewSurvey'])->name('view-survey');
    Route::post('survey-delete/{id}',[AdminSurveysController::class,'surveyDelete'])->name('survey-delete');
    Route::get('send-survey/{to}/{id}',[AdminSurveysController::class,'sendSurvey'])->name('send-survey');
    Route::get('survey-entries/{id}',[AdminSurveysController::class,'entriesSurvey'])->name('survey-entries');
    Route::get('view-entries/{id}/{uid}',[AdminSurveysController::class,'viewUserSurvey'])->name('view-entries');

      /*
    |--------------------------------------------------------------------------
    | Mapping Route
    |--------------------------------------------------------------------------
    */

    Route::get('mapping',[MappingController::class,'mapping'])->name('mapping');
    Route::post('local-user',[MappingController::class,'getUsersByCity'])->name('local-user');
    
     /*
    |--------------------------------------------------------------------------
    | Report Routes
    |--------------------------------------------------------------------------
    */
    Route::get('generate-report',[ReportController::class,'generateReport'])->name('generate-report');
    Route::get('export-excel',[ReportController::class,'exportExcel'])->name('export-excel');
    Route::get('hours',[ReportController::class,'hoursView'])->name('hours');
    Route::post('add-hours',[ReportController::class,'addHours'])->name('add-hours');
    Route::post('export-hours/{id}',[ReportController::class,'exportHours'])->name('export-hours');

      /*
    |--------------------------------------------------------------------------
    | Settings > site settings  Routes
    |--------------------------------------------------------------------------
    */
    Route::get('site-settings',[AdminSettingsController::class,'siteSetting'])->name('site-settings');
    Route::post('setting-save',[AdminSettingsController::class,'saveSetting'])->name('setting-save');

    /** Chat */
    Route::get('/learning/chat-requests', [ChatController::class, 'ticketlist'])->name('ticket-list');
    Route::get('/chat-view-ticket/{id}',[ChatController::class,'showuser'])->name('chat-view-ticket');
    Route::post('storeConversations', [ChatController::class,'store'])->name('storeConversations');
    Route::post('mark-ticket-close/{id}',[ChatController::class,'markClose'])->name('mark-ticket-close');
    Route::post('delete-ticket/{id}',[ChatController::class,'deleteTicket'])->name('delete-ticket');
});
