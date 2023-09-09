<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSurvey;
use App\Notifications\SendSurvey;
use Illuminate\Http\Request;
use MattDaneshvar\Survey\Contracts\Survey;
use MattDaneshvar\Survey\Models\Survey as ModelsSurvey;
use Illuminate\Support\Carbon;

class AdminSurveysController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth:admin');
        $this->middleware(['role:admin']);
    }

    public function index()
    {
        $surveys  = ModelsSurvey::with('questions')->get();

        return view('admin.survey.index', compact('surveys'));
    }
    public function Survey()
    {
        return view('admin.survey.add');
    }
    public function addSurvey(Request $request)
    {

        $rules = [
            'name' => 'required',
        ];

        $message = [
            'name.required' => 'Please enter form title.',
        ];

        $this->validate($request, $rules, $message);

        $survey = ModelsSurvey::create(['name' => $request->name]);

        foreach ($request->field as $k => $f) {

            if ($f['type'] == 'radio' || $f['type'] == 'multiselect') {

                $op = explode(',', $f['options']);

                $survey->questions()->create([
                    'content' => $f['content'],
                    'type' => $f['type'],
                    'options' => $op,
                    'rules' => ($f['required'] == 'yes') ? ['required'] : []
                ]);
            } else {

                $survey->questions()->create([
                    'content' => $f['content'],
                    'type' => $f['type'],
                    'rules' => ($f['required'] == 'yes') ? ['required'] : []
                ]);
            }
        }

        return redirect()->route('admin.survey-forms')->with('success', 'Survey created successfully!');
    }

    public function viewSurvey(Request $request, $id)
    {

        $survey = ModelsSurvey::find($id);

        return view('admin.survey.view-survey', compact('survey'));
    }

    public function viewUserSurvey(Request $request, $id)
    {

        $survey = ModelsSurvey::where('id', $id)->with('entries', 'questions', 'entries.answers');

        $uid = $request->uid;

        $survey = $survey->withWhereHas('entries', function ($query) use ($uid) {
            $query->where('participant_id', $uid);
        });

        $survey = $survey->get()->first();
        $question = [];
        $answers = [];
        $data = [];
        if (isset($survey->questions)) {
            foreach ($survey->questions as $q) {
                $question[] = [$q->content];
            }
        }

        if (isset($survey->entries[0]->answers)) {
            $entries = $survey->entries[0];
            foreach ($entries->answers as $a) {
                $answers[] = [$a->value];
            }
        }
        $data[] = ['questions' => $question, 'answers' => $answers];
        return view('admin.survey.view-user-survey', compact('survey', 'data'));
    }

    public function sendSurvey($to, $id)
    {
        //  $user->notify(new ApprovalNotification('branch-level'));
        $survey = ModelsSurvey::find($id);

        $users = User::query();

        if ($to == 'all') {
            $user = $users;
        }
        if ($to == 'all-volunteers') {
            $users =  $users->where('role', '=', 'volunteer')->orWhere('role', 'both');
        }
        if ($to == 'all-members') {
            $users = $users->where('role', '=', 'member')->orWhere('role', 'both');
        }
        if ($to == 'active-volunteers') {

            $users =  $users->where('role', '=', 'volunteers')->orWhere('role', 'both')->whereHas('rewards')->orwhereDate('expiry_date', '>=', Carbon::now());
        }
        if ($to == 'active-members') {
            $users->where('role', '=', 'members')->orWhere('role', 'both')->orWhere('role', 'both')->whereHas('rewards')->orwhereDate('expiry_date', '>=', Carbon::now());
        }
        $users = $users->get();

        if (isset($users) && count($users) > 0) {
            foreach ($users as $user) {

                UserSurvey::create([
                    'survey' => $survey->name,
                    'survey_id'=>$survey->id,
                    'user_id'=> $user->id,
                    'link'   => route('user-survey',['id' => base64_encode($survey->id),'uid' => base64_encode($user->id) ] ),
                    'status' => 0
                ]);

                $user->notify(new SendSurvey($survey));
            }
        }

        return redirect()->back()->with('success', 'Survey send successfully!');
    }

    public function surveyDelete($id)
    {
        ModelsSurvey::find($id)->delete();

        return redirect()->back()->with('success', 'Survey deleted successfully!');
    }

    public function entriesSurvey($id)
    {

        $survey =  ModelsSurvey::with('entries', 'entries.participant')->where('id', $id)->get()->first();

        return view('admin.survey.entries', compact('survey'));
    }
}
