<?php

namespace App\Http\Controllers\BranchLevel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'branch-level';

    /*
     * Only guests for "branch-level" guard are allowed except
     * for logout.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:branch-level');
    }

    protected function broker()
    {
        return Password::broker('branch-levels');
    }

    /*
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('branch-level.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function guard()
    {
        return Auth::guard('branch-level');
    }
}
