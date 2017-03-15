<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;

class MessagesController extends Controller
{
    public function index()
    {
        $this->setReadMessages();
        return view('agency.messages.index');
    }

    public function newMessagesCount(Request $request)
    {
        if($request->timeout > 29){
            sleep(29);
        }
        else{
            sleep($request->timeout);
        }

        $user = Auth::user();
        $data['count'] = Message::where('user2_id', $user->id)->where('unread', '1')->count();
        $data['message'] = Message::where('user2_id', $user->id)->where('unread', '1')->latest()->first();
        return $data;
    }

    private function setReadMessages()
    {
        $user = Auth::user();
        $messages = Message::where('user2_id', $user->id)->where('unread', '1')->get();
        foreach ($messages as $message){
            $message->unread = 0;
            $message->save();
        }
        return true;
    }
}
