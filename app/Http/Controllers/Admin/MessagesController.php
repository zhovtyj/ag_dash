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

}
