<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function courses(){
        $courses = Course::with('questions', 'videos')->where('status', true)->orderBy('id', 'desc')->get();
        return view('user.learning.courses.index', compact('courses'));
    }

    public function takeTest($id){
        $course = Course::with('questions', 'videos')->find($id);
        return view('user.learning.courses.test', compact('course'));
    }

    public function videos($id){
        $course = Course::with('questions', 'videos')->find($id);
        return view('user.learning.courses.videos', compact('course'));
    }

    public function submitTest(Request $request, $id){
        return $request->all();
    }

    public function result($id){
        
    }
}
