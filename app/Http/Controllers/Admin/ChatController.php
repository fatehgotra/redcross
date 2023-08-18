<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CourseChat;
use App\Models\Message;
use App\Models\MessageComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth', 'approved']);
        $this->middleware('auth:admin');
        $this->middleware(['role:admin|course-coordinator']);
    }

    public function index()
    {
        $user = User::where('id', Auth::user()->id)->get()->first();
        return view('admin.chatsystem.chatform', compact('user'));
    }
    //

    public function chat_request(Request $request)
    {

        $id = Auth::user()->id;

        $this->validate($request, [

            'enquiry_type'  => 'required',
        ]);

        $args = [

            'enquiry_type'  => $request->enquiry_type,
            'description' => $request->description,
            'created_by'  => $id,
            'status' => '1'
        ];


        CourseChat::create($args);
        return redirect()->route('ticket-list')->with('success', 'Ticket has been created successfully');
    }

    public function ticketlist()
    {
        $tickets = CourseChat::orderBy('id', 'desc')->get();
        return view('admin.chatsystem.ticketlist', compact('tickets'));
    }

    public function list()
    {
        $tickets = CourseChat::orderBy('id', 'desc')->get();
        return view('admin.CourseChat.list', compact('tickets'));
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
        $conversation = new MessageComment;
        $conversation->user_id = 0;
        $conversation->message = $request->message;
        $conversation->flex = 0;
        $conversation->message_id = $request->message_id;
        $conversation->save();

        // $chat_support = CourseChat::where('id', '=',  $request->support_id)->first();
        // $chat_support->status = 1;
        // $chat_support->save();

        return response()->json($conversation);
    }

    public function userComment(Request $request)
    {
        $conversation = new MessageComment;
        $conversation->user_id = $request->user;
        $conversation->message = $request->message;
        $conversation->message_id = $request->message_id;
        $conversation->save();
        return response()->json($conversation);
    }

    /**
     * Display the specified resource.
     */
    public function show($sid, $user)
    {

        $support = CourseChat::where('id', $sid)->with('user')->get()->first();

        $auth_user = 1;

        // check if user and auth already have a message if not create
        if (Message::where(['sender_id' => $auth_user, 'receiver_id' => $sid])->first()) {

            $message_info = Message::where(['sender_id' => $auth_user, 'receiver_id' => $sid])->first();
        } else if (Message::where(['sender_id' => $user, 'receiver_id' => $auth_user])->first()) {

            $message_info = Message::where(['sender_id' => $user, 'receiver_id' => $auth_user])->first();
        } else {
            $message_info = Message::create(
                [
                    'sender_id' => 1,
                    'receiver_id' => $sid
                ]
            );
        }

        $user_messages = User::where('id', '!=', 1)->get();

        $user = User::where('id', $sid)->first();

        $conversations =  MessageComment::where(['message_id' => $message_info->id])->get();


        return view('admin.CourseChat.view', compact('support', 'user_messages', 'conversations', 'message_info'));
    }

    public function showuser($sid)
    {

        $support = CourseChat::where('id', $sid)->with('user')->get()->first();

        $auth_user = 1;

        $message_info = Message::where(['sender_id' => $auth_user, 'receiver_id' => $sid])->first();

        if (is_null($message_info)) {

            $message_info = Message::create(
                [
                    'sender_id' => 1,
                    'receiver_id' => $sid
                ]
            );
        }

        $user_messages = User::where('id', '!=', 1)->get();

        $user = User::where('id', $sid)->first();

        $conversations =  MessageComment::where(['message_id' => $message_info->id])->get();

        return view('admin.chatsystem.view', compact('support', 'user_messages', 'conversations', 'message_info'));
    }

    public function getConversations(Request $request)
    {
        $conversations =  MessageComment::where(['message_id' => $request->id])->with('user')->get();
        return $conversations;
    }

    public function markClose($id)
    {
        CourseChat::where('id', $id)->update(['status' => 0]);
        return redirect()->route('admin.ticket-list')->with('success', 'Ticket Close successfully!');
    }

    public function deleteTicket($id)
    {
        CourseChat::find($id)->delete();
        return redirect()->route('admin.ticket-list')->with('success', 'Ticket deleted successfully!');
    }
}
