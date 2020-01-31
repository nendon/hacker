<?php

namespace App\Mail;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuksesMail extends Mailable
{
    use Queueable, SerializesModels;

    // public $send;

    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->send = $send;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Selamat! Anda Sukses membeli tutorial di cilsy')
                    ->view('mail.sukses_bayar');
    }
}
