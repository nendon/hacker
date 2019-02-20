<?php

namespace App\Listeners\ContribAuth;

use App\Events\ContribAuth\ContribActivationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use App\Mail\Auth\ActivationEmail;

class SendActivationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContribActivationEmail  $event
     * @return void
     */
    public function handle(ContribActivationEmail $event)
    {
        if($event->contributor->active) {
            return;
        }
        Mail::to($event->contributor->email)->send(new ActivationEmail($event->contrib));
    }
}
