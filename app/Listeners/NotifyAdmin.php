<?php

namespace App\Listeners;

use App\Events\NewUserAdded;
use App\Notifications\AdminNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NotifyAdmin
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
     * @param  object  $event
     * @return void
     */
    public function handle(NewUserAdded $event)
    {

        Notification::route('mail', 'admin@hasob.com')
            ->notify( new AdminNotification());
        //
    }
}
