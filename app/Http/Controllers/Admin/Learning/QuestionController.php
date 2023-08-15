<?php

namespace App\Http\Controllers\Admin\Learning;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware(['role:admin|course-coordinator']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter_course    = $request->filter_course;

        $questions = Question::orderBy('id', 'desc');

        if($filter_course){
            $questions->where('course_id', $filter_course);
        }

        $questions = $questions->get();
        return view('admin.learning.mcqs.index', compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses            = Course::where('status', true)->get();
        return view('admin.learning.mcqs.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'course_id'                     => 'required',
            'question'                      => 'required',
            'option_1'                      => 'required',
            'option_2'                      => 'required',
            'option_3'                      => 'required',
            'option_4'                      => 'required',
            'correct_option'                => 'required',
            'status'                        => 'required',
        ];

        $messages = [
            'course_id.required'            => 'Please choose course',
            'question.required'             => 'Please enter question.',
            'option_1.required'             => 'Please enter option 1',
            'option_2.required'             => 'Please enter option 2',
            'option_3.required'             => 'Please enter option 3',
            'option_4.required'             => 'Please enter option 4',
            'correct_option.required'       => 'Please choose correct option',
            'status.required'               => 'Please choose status',
        ];

        $this->validate($request, $rules, $messages); 

        Question::create([
            'course_id'         => $request->course_id,
            'question'          => $request->question,
            'option_1'          => $request->option_1,
            'option_2'          => $request->option_2,
            'option_3'          => $request->option_3,
            'option_4'          => $request->option_4,
            'correct_option'    => $request->correct_option,
            'status'            => $request->status,
        ]);

        return redirect()->route('admin.mcqs.index')->with('success', 'Question added successfully!');
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
        $courses        = Course::where('status', true)->get();
        $question       = Question::find($id);
        return view('admin.learning.mcqs.edit', compact('courses', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'course_id'                     => 'required',
            'question'                      => 'required',
            'option_1'                      => 'required',
            'option_2'                      => 'required',
            'option_3'                      => 'required',
            'option_4'                      => 'required',
            'correct_option'                => 'required',
            'status'                        => 'required',
        ];

        $messages = [
            'course_id.required'            => 'Please choose course',
            'question.required'             => 'Please enter question.',
            'option_1.required'             => 'Please enter option 1',
            'option_2.required'             => 'Please enter option 2',
            'option_3.required'             => 'Please enter option 3',
            'option_4.required'             => 'Please enter option 4',
            'correct_option.required'       => 'Please choose correct option',
            'status.required'               => 'Please choose status',
        ];

        $this->validate($request, $rules, $messages); 

        Question::find($id)->update([
            'course_id'         => $request->course_id,
            'question'          => $request->question,
            'option_1'          => $request->option_1,
            'option_2'          => $request->option_2,
            'option_3'          => $request->option_3,
            'option_4'          => $request->option_4,
            'correct_option'    => $request->correct_option,
            'status'            => $request->status,
        ]);

        return redirect()->route('admin.mcqs.index')->with('success', 'Question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Question::find($id)->delete();
        return redirect()->route('admin.mcqs.index')->with('success', 'Question deleted successfully!');
    }
}
