<?php

namespace App\Listeners;

use App\Notifications\UserNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\NewUserAdded;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailToNewUser
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
     * @param  AppEvents\NewUserAdded  $event
     * @return void
     */
    public function handle(NewUserAdded $event)
    {
        //send email to new user
        $event->user->notify(new UserNotification());

    }
}
