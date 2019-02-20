<?php

namespace App\Listeners;

use App\Events\ContributorRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Auth\ActivationMail;
use Mail;

class SendContributorActivation
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
     * @param  ContributorRegistered  $event
     * @return void
     */
    public function handle(ContributorRegistered $event)
    {
        if($event->contributor->active) {
            return;
        }
        Mail::to($event->contributor->email)->send(new ActivationMail($event->contributor));
    }
}
