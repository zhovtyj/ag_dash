<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessagePosted;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Message;
use App\User;



class MessagesController extends Controller
{
    public function index($agency_id)
    {
        $agency = User::find($agency_id);
        $this->setReadMessages($agency_id);
        return view('admin.messages.index')->withAgency($agency);
    }

    public function messages($agency_id)
    {
        $GLOBALS['AGENCY_ID'] = $agency_id;
        return Message::with('user')
            ->where('user_id', $agency_id)
            ->where('user2_id', '1')
            ->orwhere(function ($query){
                $query->where('user_id', '1')
                    ->where('user2_id', $GLOBALS['AGENCY_ID']);
            })
            ->with('user')
            ->get();
    }

    public function threads()
    {
        $user_ids = Message::select('user_id')
            ->where('user_id', '<>', '1')
            ->orderBy('id', 'asc')
            ->groupBy('user_id')
            ->get();

        $threads = array();
        foreach ($user_ids as $id){
            $user = User::find($id);
            $threads[] = $user->messages()->latest()->first();
        }
        $unread = Message::where('user2_id', '1')->where('unread', '1')->count();

        return view('admin.messages.threads')->withThreads($threads)->withUnread($unread);
    }

    public function store(Request $request, $agency_id)
    {

        $user = Auth::user();
        $message = new Message;
        $message->user()->associate($user);

        if($user->id == $agency_id){
            $message->user2_id = 1;
        }else{
            $message->user2_id = $agency_id;
        }

        $message->message = $request->message;
        $message->save();

        broadcast(new MessagePosted($message, $user));

        return ['status'=> 'OK'];
    }

    public function fileUpload(Request $request, $agency_id)
    {
        if ($request->hasfile('document')){
            $document = $request->file('document');
            $filename = time().'-'.$document->getClientOriginalName();
            $path = $document->storeAs('documents', $filename);

        }
        $data['filename'] = $filename;
        $data['path'] = $path;

        //New Message
        $user = Auth::user();
        $message = new Message;
        $message->user()->associate($user);

        if($user->id == $agency_id){
            $message->user2_id = 1;
        }else{
            $message->user2_id = $agency_id;
        }

        $message->message = '<a href="/public/'.$path.'" target="_blank">'.$request->file('document')->getClientOriginalName().'</a>';
        $message->save();

        broadcast(new MessagePosted($message, $user));

        return $data;
    }

    public function newMessagesCount(Request $request)
    {
        if($request->timeout > 29){
            sleep(29);
        }
        else{
            sleep($request->timeout);
        }

        $data['count'] = Message::where('user2_id', 1)->where('unread', '1')->count();
        $data['message'] = Message::where('user2_id', 1)->where('unread', '1')->latest()->first();
        return $data;
    }

    private function setReadMessages($agency_id)
    {
        $messages = Message::where('user_id', $agency_id)->where('unread', '1')->get();
        foreach ($messages as $message){
            $message->unread = 0;
            $message->save();
        }
        return true;
    }

}
