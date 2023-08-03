<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\ApprovalHistory;
use App\Models\Blog;
use App\Models\Campaign;
use App\Models\CampaignUser;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'approved']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $approval_history = ApprovalHistory::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $alerts = Alert::orderBy('id', 'desc')->where('status', true)->take(5)->get();
        $updates = Blog::orderBy('id', 'desc')->where('status', true)->take(5)->get();
        $campaigns = Campaign::orderBy('id', 'desc')->take(5)->get();
        $user_campaigns =  CampaignUser::where('user_id', Auth::user()->id)->pluck('campaign_id')->toArray();
        return view('user.dashboard.dashboard', compact('approval_history', 'alerts', 'updates', 'campaigns', 'user_campaigns'));
    }

    
}
