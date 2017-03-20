<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrelloBoards extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public $category_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $category_id)
    {
        $this->order = $order;

        $this->category_id = $category_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@agency.irank.website')->view('email.newOrderTrelloBoards');
    }
}
