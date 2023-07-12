<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
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
        $updates = Blog::orderBy('id', 'desc')->get();
        return view('admin.updates.index', compact('updates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.updates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'content'       => 'required',           
            'status'        => 'required'
        ]);

        Blog::create([
            'title'         => $request->title,
            'content'       => $request->content,
            'status'        => $request->status
        ]);

        return redirect()->route('admin.updates.index')->with('sucess', 'Update created successfully!');
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
        $update = Blog::find($id);
        return view('admin.updates.edit', compact('update'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'         => 'required',
            'content'       => 'required',            
            'status'        => 'required'
        ]);

        Blog::find($id)->update([
            'title'         => $request->title,
            'content'       => $request->content,
            'status'        => $request->status
        ]);

        return redirect()->route('admin.updates.index')->with('sucess', 'Update updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Blog::find($id)->delete();
        return redirect()->route('admin.updates.index')->with('sucess', 'Update deleted successfully!');
    }
}
