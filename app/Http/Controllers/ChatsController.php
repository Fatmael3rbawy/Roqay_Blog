<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        dd( Message::with('user')->get() );
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user()->id;

        $message = Message::create([
            'message' => $request->input('message'),
            'user_id' => $user
        ]);

      //  dd(event(new MessageSent($request->user , $request->message)));
      broadcast(new MessageSent($user, $message->message))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}
