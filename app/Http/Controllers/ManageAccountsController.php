<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Client;
use App\ClientStatus;
use App\Note;
use App\Tag;
use Illuminate\Support\Facades\Mail;
use App\Mail\ManageClientsMail;

class ManageAccountsController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $clients = Client::where('user_id', '=', $user->id)->get();
        $tags = Tag::all();
        $statuses = ClientStatus::all();
        return view('agency.manageAccounts.index')->withClients($clients)->withTags($tags)->withStatuses($statuses);
    }

    public function notesStore(Request $request)
    {
        $note = Note::where('client_id', $request->client_id)->first();
        if($note){
            $note->client_id = $request->client_id;
            $note->body = $request->body;
            $note->save();
            return ('updated');
        }
        else{
            $new_note = new Note();
            $new_note->client_id = $request->client_id;
            $new_note->body = $request->body;
            $new_note->save();
            return ('created');
        }
    }

    public function clientAjax(Request $request)
    {
        $client = Client::find($request->id);
        return($client->tags);
    }

    public function tagsStore(Request $request)
    {
        $client = Client::find($request->client_id);
        $client->tags()->sync($request->tags, true);
        return($client->tags);
    }

    public function statusStore(Request $request)
    {
        $client = Client::find($request->client_id);
        $client->client_status_id = $request->status;
        $client->save();
        return ($client->clientStatus->name);
    }

    public function sendEmail(Request $request)
    {
        $client = Client::find($request->client_id);
        $message = array();
        $message['message'] = $request->message;
        Mail::to($client->business_owners_email)->send(new ManageClientsMail($message));
        return('true');
    }
}
