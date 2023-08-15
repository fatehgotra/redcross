<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MappingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function mapping(){

        return view('admin.mapping.map');
    }
    public function getUsersByCity(Request $request){
      
        $city = $request->city;
        $users = User::with('contactInformation')->where('branch','=',$city)
                 ->where('status','approve')->where('expiry_date','>=',Carbon::now());
       
        $users = $users->get();
         
        return response()->json([
            'users'=>$users
        ]);
    }
}
