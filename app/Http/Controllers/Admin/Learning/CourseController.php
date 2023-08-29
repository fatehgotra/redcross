<?php

namespace App\Http\Controllers\Admin\Learning;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\TestAttempt;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['role:admin|course-coordinator']);
     
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses            = Course::orderBy('id', 'desc')->get();
        return view('admin.learning.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.learning.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                  => ['required', 'string', 'max:255'],  
            'description'           => ['required'],   
            'status'                => ['required'],
            'test_reward_points'    => ['required'],  
            'video_reward_points'   => ['required'],        
        ];

        $messages = [
            'name.required'                     => 'Please enter course name.', 
            'description'                       => 'Please enter course description.', 
            'status.required'                   => 'Please enter course status.',
            'test_reward_points.required'       => 'Please enter test reward points.',                
            'video_reward_points.required'      => 'Please enter video reward points.',          
        ];

        $this->validate($request, $rules, $messages);

        $course                   = Course::create([
            'name'                => $request->name,
            'description'         => $request->description,
            'test_reward_points'  => $request->test_reward_points,
            'video_reward_points' => $request->video_reward_points,
            'status'              => $request->status           
        ]);        

        return redirect()->route('admin.courses.index')->with('success', 'Course added successfully!');
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
        $course            = Course::find($id);
        return view('admin.learning.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name'                  => ['required', 'string', 'max:255'],  
            'description'           => ['required'],   
            'status'                => ['required'],  
            'test_reward_points'    => ['required'],  
            'video_reward_points'   => ['required'],          
        ];

        $messages = [
            'name.required'                     => 'Please enter course name.', 
            'description'                       => 'Please enter course description.', 
            'status.required'                   => 'Please enter course status.', 
            'test_reward_points.required'       => 'Please enter test reward points.',                
            'video_reward_points.required'      => 'Please enter video reward points.',       
        ];

        $this->validate($request, $rules, $messages);

        $course                   = Course::find($id)->update([
            'name'                => $request->name,
            'description'         => $request->description,
            'test_reward_points'  => $request->test_reward_points,
            'video_reward_points' => $request->video_reward_points,
            'status'              => $request->status           
        ]);        

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Course::find($id)->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully!');
    }

}
