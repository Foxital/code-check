<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $getrd = $this->order;

        $subject = 'Reyo: Hey! Your order #'.$getrd['id'].' is confirmed.';
        
        return $this->subject($subject)->view('Admin.emails')->with([
            'status' => $getrd['status'],
            'name' => $getrd['name'],
            'id' => $getrd['id']
        ]);
    }
}
