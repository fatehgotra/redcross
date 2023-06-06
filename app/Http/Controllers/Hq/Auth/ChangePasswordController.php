<?php

namespace App\Http\Controllers\Hq\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Hq;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hq');
    }

    public function changePasswordForm()
    {
        $id         = Auth::guard('hq')->id();
        $user       = Hq::find($id);
        return view('hq.settings.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $id         = Auth::guard('hq')->id();

        $this->validate($request, [
            'current_password'  => 'required',
            'new_password'          => 'required|min:8|confirmed',

        ]);

        $user       = Hq::find($id);

        if (Hash::check($request->get('current_password'), $user->password)) {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('hq.password.form')->with('success', 'Password changed successfully!');

        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        return redirect()->route('hq.password.form')->with('success', 'Password changed successfully');
    }

}
