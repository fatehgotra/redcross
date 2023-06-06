<?php

namespace App\Http\Controllers\BranchLevel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\BranchLevel;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:branch-level');
    }

    public function changePasswordForm()
    {
        $id         = Auth::guard('branch-level')->id();
        $user       = BranchLevel::find($id);
        return view('branch-level.settings.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $id         = Auth::guard('branch-level')->id();

        $this->validate($request, [
            'current_password'  => 'required',
            'new_password'          => 'required|min:8|confirmed',

        ]);

        $user       = BranchLevel::find($id);

        if (Hash::check($request->get('current_password'), $user->password)) {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('branch-level.password.form')->with('success', 'Password changed successfully!');

        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        return redirect()->route('branch-level.password.form')->with('success', 'Password changed successfully');
    }

}
