<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailReminderKeempat extends Mailable
{
    use Queueable, SerializesModels;

    public $lessons;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->lessons = $lessons;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Anda sudah pesan tapi...')
                    ->view('mail.reminder_keempat');
    }
}
