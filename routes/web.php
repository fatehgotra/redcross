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

/* Volunteer Registration Lodge Information (Step 1)*/
Route::get('volunteer-registration/lodge-information', [VolunteerController::class, 'lodgeInformationForm'])->name('lodge-information.form');
Route::post('volunteer-registration/lodge-information', [VolunteerController::class, 'lodgeInformation'])->name('lodge-information');

/* Volunteer Registration Personal Information (Step 2)*/
Route::get('volunteer-registration/personal-information', [VolunteerController::class, 'personalInformationForm'])->name('personal-information.form');
Route::post('volunteer-registration/personal-information', [VolunteerController::class, 'personalInformation'])->name('personal-information');

/* Volunteer Registration Contact Information (Step 3)*/
Route::get('volunteer-registration/contact-information', [VolunteerController::class, 'contactInformationForm'])->name('contact-information.form');
Route::post('volunteer-registration/contact-information', [VolunteerController::class, 'contactInformation'])->name('contact-information');