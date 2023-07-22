<?php

namespace App\Http\Middleware;

use Closure;
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
        if(auth()->check() && (auth()->user()->status !== 'approve') && (auth()->user()->approved_by !== 'HQ')){           

            if(auth()->user()->role == 'volunteer'){
                Auth::logout();
                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect()->route('index')->with('error', 'Your Account is pending for approval. You will be notified via email once all approvals are done.');
            }else{
                Auth::logout();
                $request->session()->invalidate();

                $request->session()->regenerateToken();
                return redirect()->route('payment-details')->with('error', 'Your Account is pending for approval. You will be notified via email once all approvals are done. In the meanwhile please pay membership fees.');
            }

            return redirect()->route('index')->with('error', 'Your Account is pending for approval. You will be notified via email once all approvals are done.');

        }

        return $next($request);
    }
}
