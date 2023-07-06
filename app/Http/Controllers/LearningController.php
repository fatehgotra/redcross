<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use App\Models\TestAttempt;
use App\Models\TestResponse;
use App\Models\UserReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function courses()
    {
        $courses = Course::with('questions', 'videos')->where('status', true)->orderBy('id', 'desc')->get();
        $courses->map(function ($item) {
            $item->attempted    = TestAttempt::where('course_id', $item->id)->where('user_id', Auth::user()->id)->exists(); 
            $item->attempt_id   = $item->attempted ? TestAttempt::where('course_id', $item->id)->where('user_id', Auth::user()->id)->first()->id : null;           
            return $item;
        });
        return view('user.learning.courses.index', compact('courses'));
    }

    public function takeTest($id)
    {
        $course                             = Course::with('questions', 'videos')->find($id);
        $attempt                            = new TestAttempt();
        $attempt->user_id                   = Auth::user()->id;
        $attempt->course_id                 = $id;
        $attempt->save();
        return view('user.learning.courses.test', compact('course', 'attempt'));
    }

    public function exitTest(Request $request, $id)
    {
        TestAttempt::where('id', $id)->delete();
        return redirect()->route('learning.courses')->with('success', 'Test has been cancelled successfully');
    }

    public function videos($id)
    {
        $course = Course::with('questions', 'videos')->find($id);
        UserReward::updateOrCreate([
            'course_id' => $id,
            'user_id' => Auth::user()->id,
            'reward_for' => 'video'
        ], [            
            'points'    => Course::find($id)->video_reward_points
        ]);
        return view('user.learning.courses.videos', compact('course'));
    }

    public function submitTest(Request $request, $id)
    {
        

        if (is_array($request->question) && !empty($request->question)) {
            foreach ($request->question as $key => $value) {
                $response                   = new TestResponse();
                $response->test_attempt_id  = $request->test_attempt_id;
                $response->user_id          = Auth::user()->id;
                $response->course_id        = $id;
                $response->question_id      = $value['question_id'];
                $response->attempted        = isset($value['answer']) ? 'yes' : 'no';              
                $response->option           = isset($value['answer']) ? $value['answer'] : null;
                $correct_option             = Question::where('id', $value['question_id'])->value('correct_option');
                $response->correct          = (isset($value['answer']) && ($value['answer'] == $correct_option)) ? 'yes' : 'no';
                $response->save();
            }
        }

        $correct        = TestResponse::where('test_attempt_id', $response->test_attempt_id)->where('correct', 'yes')->count();
        $incorrect      = TestResponse::where('test_attempt_id', $response->test_attempt_id)->where('correct', 'no')->count();
        $unattempted    = TestResponse::where('test_attempt_id', $response->test_attempt_id)->where('attempted', 'no')->count();

        TestAttempt::where('id', $response->test_attempt_id)->update([
            'ends_at'        => now(),
            'correct'        => $correct,
            'incorrect'      => $incorrect,
            'unattempted'    => $unattempted
        ]);

        UserReward::updateOrCreate([
            'course_id' => $id,
            'user_id' => Auth::user()->id,
            'reward_for' => 'test'
        ], [            
            'points'    => Course::find($id)->test_reward_points
        ]);

        return redirect()->route('learning.result', $response->test_attempt_id)->with('success', 'Test has been submitted successfully');

    }

    public function result($id)
    {
        $attempt            = TestAttempt::find($id);
        $responses          = TestResponse::with('question')->where('test_attempt_id', $id)->get();
        
        return view('user.learning.courses.result', compact('attempt', 'responses'));
    }
}
