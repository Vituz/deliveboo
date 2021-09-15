<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;
    public $cart;
    public $restaurant;
    public function __construct(array $data, array $cart, $restaurant)
    {
        $this->data = $data;
        $this->cart = $cart;
        $this->restaurant = $restaurant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('delivebooh@mail.com')->subject('New Order')->view('mail.orderRecap');
    }
}
