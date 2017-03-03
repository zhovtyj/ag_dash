<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessagePosted;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Message;


class MessagesController extends Controller
{
    public function index()
    {
        return view('admin.messages.index');
    }

    public function messages()
    {
        return Message::with('user')->get();
    }

    public function store(Request $request)
    {

        $user = Auth::user();

        $message = new Message;
        $message->user()->associate($user);
        $message->message = $request->message;
        $message->save();

        broadcast(new MessagePosted($message, $user));

        return ['status'=> 'OK'];
    }

}
