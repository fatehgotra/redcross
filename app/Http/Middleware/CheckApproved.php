<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */    

    public function handle(Request $request, Closure $next)
    {

        if(auth()->check() && (auth()->user()->status == 'approve') && (auth()->user()->approved_by == 'HQ')){  
            
            if( auth()->user()->expiry_date <= Carbon::now()->format('Y-m-d')  ){
                return redirect()->route('index')->with('error', 'Your Account is expired , Please contact admin or your branch to enable it.');
            } 
            else{
                return $next($request);
            }

        }
       
        if(auth()->check() && (auth()->user()->status == 'approve') && (auth()->user()->approved_by == 'HQ')){           
          
            $lodgment = Session::get('lodgement-information');
            
            if( auth()->user()->expiry_date <= Carbon::now()->format('Y-m-d')){
               
            if(auth()->user()->role == 'volunteer' || ( isset($lodgment) && $lodgment['role'] == 'volunteer' ) ){
                Auth::logout();
                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect()->route('index')->with('error', 'Your Account is pending for approval. You will be notified via email once all approvals are done.');
            }else{
                $id = Auth::user()->id;
                Auth::logout();
                $request->session()->invalidate();

                $request->session()->regenerateToken();
                
                return redirect()->route('payment-details',compact('id'))->with('error', 'Your Account is pending for approval. You will be notified via email once all approvals are done. In the meanwhile please pay membership fees.');
            }
        } 
       
        return $next($request);

            //return redirect()->route('index')->with('error', 'Your Account is pending for approval. You will be notified via email once all approvals are done.');

        }  else {
           
            if(auth()->user()->role == 'volunteer' || ( isset($lodgment) && $lodgment['role'] == 'volunteer' ) ){

                Auth::logout();
                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect()->route('index')->with('error', 'Your Account is pending for approval. You will be notified via email once all approvals are done.');
            }else{
                $id = Auth::user()->id;
                Auth::logout();
                $request->session()->invalidate();

                $request->session()->regenerateToken();
                
                return redirect()->route('payment-details',compact('id'))->with('error', 'Your Account is pending for approval. You will be notified via email once all approvals are done. In the meanwhile please pay membership fees.');
            }

        }
    

        return $next($request);
    }
}
