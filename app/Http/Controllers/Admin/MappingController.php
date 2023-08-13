<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $users = User::with('contactInformation')->where('branch','=',$city);
        
        
        // $users = $users->withWhereHas('lodgementInformation',function( $q ) use( $city ) {
           
        //     $q->where('registration_location_type','=',$city);

        // });
        
        $users = $users->get();
         
        return response()->json([
            'users'=>$users
        ]);
    }
}
