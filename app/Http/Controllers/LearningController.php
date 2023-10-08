<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use App\Models\Course;
use App\Models\CourseDocument;
use App\Models\Question;
use App\Models\TestAttempt;
use App\Models\TestResponse;
use App\Models\User;
use App\Models\UserReward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class LearningController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'approved']);
    }

    public function courses(Request $request)
    {
        $search = $request->course;
        if( !is_null($search) ){
           
            $courses = Course::with('questions', 'videos')->where('status', true)->where('name','like','%'.$request->course.'%')->orderBy('id', 'desc')->get();

        } else{
            $courses = Course::with('questions', 'videos')->where('status', true)->orderBy('id', 'desc')->get();
        }
      

        $courses->map(function ($item) {
            $item->attempted        = TestAttempt::where('course_id', $item->id)->where('user_id', Auth::user()->id)->exists(); 
            $item->unblock_after    = $item->attempted ? Carbon::parse(TestAttempt::where('course_id', $item->id)->where('user_id', Auth::user()->id)->first()->created_at)->diffInDays(Carbon::now()) : 3;
            $item->attempt_id       = $item->attempted ? TestAttempt::where('course_id', $item->id)->where('user_id', Auth::user()->id)->first()->id : null;           
            return $item;
        });
        
        return view('user.learning.courses.index', compact('courses','search'));
    }

    public function takeTest($id)
    {
        TestAttempt::where('course_id', $id)->where('user_id', Auth::user()->id)->delete();
        TestResponse::where('course_id', $id)->where('user_id', Auth::user()->id)->delete();
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

    public function documents($id)
    {
        $course    = Course::find($id);
        $documents = CourseDocument::with('course')->where('course_id', $id)->get();
        return view('user.learning.courses.documents', compact('course', 'documents'));
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

        $attempt            = TestAttempt::find( $response->test_attempt_id );

        $percentage = ($attempt->correct / count($attempt->responses) * 100);
        
        if( $percentage >= 80 ){

            UserReward::updateOrCreate([
                'course_id' => $id,
                'user_id' => Auth::user()->id,
                'reward_for' => 'test'
            ], [            
                'points'    => Course::find($id)->test_reward_points
            ]);

        }
       
        return redirect()->route('learning.result', $response->test_attempt_id)->with('success', 'Test has been submitted successfully');

    }

    public function result($id)
    {
        $attempt            = TestAttempt::find($id);
        $responses          = TestResponse::with('question')->where('test_attempt_id', $id)->get();

        $_check = certificate::where(['course_id'=>$attempt->course_id,'user_id'=>$attempt->user_id])->first();
        $_per  =  ($attempt->correct / count($attempt->responses) * 100);

        $cert = null;

        if( is_null($_check) && $_per >= 80 ){

        $cid = base64_decode($attempt->course_id);
        $uid = base64_decode($attempt->user_id);

        $cert = certificate::create([

            'user_id'     =>$attempt->user_id,
            'course_id'   => $attempt->course_id,
            'course_name' => Course::find( $attempt->course_id )->name,
        ]);

        }
        
        return view('user.learning.courses.result', compact('attempt', 'responses','cert'));
    }

    public function certificate( $id, $cid ,$cert_id ){
        
        $id = base64_decode( $id );
        $user   = User::find( $id );
        $course =  Course::find( base64_decode($cid) );
        $cert = certificate::find( base64_decode($cert_id) );

        return view('user.learning.courses.certificate',compact('user','course','cert') );
    }

    public function certificates(){

        $certificates = certificate::where('user_id',Auth::user()->id)->get();

        return view('user.learning.certificates',compact('certificates'));
    }
}
