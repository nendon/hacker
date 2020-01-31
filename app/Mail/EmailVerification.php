<?php

namespace App\Mail;

use App\Models\Contributor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $contributor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contributors $contributor)
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
        return $this->view('mail.verification_contributor')
                    ->with($this->contributor->token);
    }
}
