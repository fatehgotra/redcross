<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
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
        $alerts = Alert::orderBy('id', 'desc')->get();
        return view('admin.alerts.index', compact('alerts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.alerts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'priority'      => 'required',
            'status'        => 'required'
        ]);

        Alert::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'priority'      => $request->priority,
            'status'        => $request->status
        ]);

        return redirect()->route('admin.alerts.index')->with('sucess', 'Alert created successfully!');
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
        $alert = Alert::find($id);
        return view('admin.alerts.edit', compact('alert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'priority'      => 'required',
            'status'        => 'required'
        ]);

        Alert::find($id)->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'priority'      => $request->priority,
            'status'        => $request->status
        ]);

        return redirect()->route('admin.alerts.index')->with('sucess', 'Alert deleted successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Alert::find($id)->delete();
        return redirect()->route('admin.alerts.index')->with('sucess', 'Alert deleted successfully!');
    }
}
