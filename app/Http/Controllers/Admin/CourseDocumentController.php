<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseDocument;
use Illuminate\Http\Request;

class CourseDocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $course    = Course::find($request->course_id);
        $documents = CourseDocument::with('course')->where('course_id', $request->course_id)->get();
        return view('admin.learning.courses.documents', compact('documents', 'course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->hasfile('document')) {
            $document = $request->file('document');
            $name     = time() . '.' . $document->getClientOriginalExtension();
            $document->storeAs('uploads/courses/' . $id . '/documents', $name, 'public');
           
            $doc            = new CourseDocument();
            $doc->course_id = $id;
            $doc->title     = $request->title;
            $doc->document  = $name;
            $doc->save();

            return redirect()->route('admin.course-documents.index', ['course_id'  => $id])->with('success', 'Document added to course successfully');
        }

        return redirect()->route('admin.course-documents.index', ['course_id'  => $id])->with('error', 'Please upload document!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cid = CourseDocument::find($id)->course_id;
        CourseDocument::find($id)->delete();
        return redirect()->route('admin.course-documents.index', ['course_id'  => $cid])->with('success', 'Document deleted successfully');
    }
}
