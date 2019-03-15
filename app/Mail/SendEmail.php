<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $token;
    private $base;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($base, $token)
    {
        $this->token = $token;
        $this->base = $base;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link = $this->base . "/activate/" . $this->token;
        return $this->view('email.activate')->with("link",$link);
    }
}
