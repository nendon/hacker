<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Contributor;


class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contributor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contributor $contributor)
    {
        $this->contributor = $contributor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.activation');
        
    }
}
