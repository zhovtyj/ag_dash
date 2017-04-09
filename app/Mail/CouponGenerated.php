<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CouponGenerated extends Mailable
{
    use Queueable, SerializesModels;

    public $coupon;


    public function __construct($coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@agency.irank.website')->view('email.newCouponGenerated');
    }
}
