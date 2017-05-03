<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class ManageClientsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email_message;
    public $subject;

    public function __construct($email_message, $subject)
    {
        $this->email_message = $email_message;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->from(Auth::user()->email)->subject($this->subject)->view('email.manageClientsMail');
    }
}
