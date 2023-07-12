<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campaigns = Campaign::orderBy('id', 'desc')->get();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'starts_at'     => 'required',
            'ends_at'       => 'required',
            'entry_closed'  => 'required'
        ]);

        Campaign::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'starts_at'     => $request->starts_at,
            'ends_at'       => $request->ends_at,
            'entry_closed'  => $request->entry_closed
        ]);

        return redirect()->route('admin.campaigns.index')->with('sucess', 'Campaign created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $campaign = Campaign::find($id);
        return view('admin.campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'starts_at'     => 'required',
            'ends_at'       => 'required',
            'entry_closed'  => 'required'
        ]);

        Campaign::find($id)->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'starts_at'     => $request->starts_at,
            'ends_at'       => $request->ends_at,
            'entry_closed'  => $request->entry_closed
        ]);

        return redirect()->route('admin.campaigns.index')->with('sucess', 'Campaign deleted successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Campaign::find($id)->delete();
        return redirect()->route('admin.campaigns.index')->with('sucess', 'Campaign deleted successfully!');
    }
}
