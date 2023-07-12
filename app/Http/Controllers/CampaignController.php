<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'approved']);
    }

    public function index(){
        $campaigns = Campaign::orderBy('id', 'desc')->paginate(5);
        $user_campaigns =  CampaignUser::where('user_id', Auth::user()->id)->pluck('campaign_id')->toArray();
        return view('user.campaigns.index', compact('campaigns', 'user_campaigns'));
    }

    public function join(Request $request, $id)
    {
        CampaignUser::create([
            'user_id'   => Auth::user()->id,
            'campaign_id' => $id
        ]);

        return redirect()->back()->with('success', 'You have joined the campaign successfully');
    }
}
