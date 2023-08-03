<?php

namespace App\Http\Controllers\Admin\Learning;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['role:admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter_course    = $request->filter_course;

        $videos = Video::orderBy('id', 'desc');

        if($filter_course){
            $videos->where('course_id', $filter_course);
        }

        $videos = $videos->get();
        return view('admin.learning.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses            = Course::where('status', true)->get();
        return view('admin.learning.videos.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'course_id'                  => 'required',
            'url'                        => 'required',
            'title'                      => 'required',
            'description'                => 'required',
            'status'                     => 'required'
        ];

        $messages = [
            'course_id.required'            => 'Please choose course',
            'url.required'                  => 'Please enter video url.',
            'title.required'                => 'Please enter video title',
            'description.required'          => 'Please enter video description',     
            'status.required'               => 'Please choose status',       
        ];

        $this->validate($request, $rules, $messages); 

        Video::create([
            'course_id'         => $request->course_id,
            'url'               => $request->url,
            'title'             => $request->title,
            'description'       => $request->description,            
            'status'            => $request->status,
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $video          = Video::find($id);
        return view('admin.learning.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $courses        = Course::where('status', true)->get();
        $video          = Video::find($id);
        return view('admin.learning.videos.edit', compact('courses', 'video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'course_id'                  => 'required',
            'url'                        => 'required',
            'title'                      => 'required',
            'description'                => 'required',
            'status'                     => 'required'
        ];

        $messages = [
            'course_id.required'            => 'Please choose course',
            'url.required'                  => 'Please enter video url.',
            'title.required'                => 'Please enter video title',
            'description.required'          => 'Please enter video description',     
            'status.required'               => 'Please choose status',       
        ];

        $this->validate($request, $rules, $messages); 

        Video::find($id)->update([
            'course_id'         => $request->course_id,
            'url'               => $request->url,
            'title'             => $request->title,
            'description'       => $request->description,            
            'status'            => $request->status,
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Video::find($id)->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully!');
    }
}
