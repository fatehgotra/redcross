<?php

namespace App\Http\Controllers\DivisionManager\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\DivisionManager;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:division-manager');
    }

    public function changePasswordForm()
    {
        $id         = Auth::guard('division-manager')->id();
        $user       = DivisionManager::find($id);
        return view('division-manager.settings.change-password', compact('user'));
    }

    public function changePassword(Request $request)
    {
        $id         = Auth::guard('division-manager')->id();

        $this->validate($request, [
            'current_password'  => 'required',
            'new_password'          => 'required|min:8|confirmed',

        ]);

        $user       = DivisionManager::find($id);

        if (Hash::check($request->get('current_password'), $user->password)) {

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('division-manager.password.form')->with('success', 'Password changed successfully!');

        } else {

            return redirect()->back()->with('error', 'Current password is incorrect');
        }

        return redirect()->route('division-manager.password.form')->with('success', 'Password changed successfully');
    }

}
