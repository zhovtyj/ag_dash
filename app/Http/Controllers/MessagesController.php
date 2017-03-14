<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;

class MessagesController extends Controller
{
    public function index()
    {
        return view('agency.messages.index');
    }

    public function newMessagesCount()
    {
        $user = Auth::user();
        $count = Message::where('user2_id', $user->id)->where('unread', '1')->count();
        return $count;
    }
}
