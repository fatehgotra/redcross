<?php

namespace App\Http\Controllers\BranchLevel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /*
     * Only guests for "superadmin" guard are allowed except
     * for logout.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:branch-level');
    }

    public function showLinkRequestForm()
    {
        return view('branch-level.auth.passwords.email');
    }

    protected function broker()
    {
        return Password::broker('branch-levels');
    }

    public function guard()
    {
        return Auth::guard('branch-level');
    }

}
