<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\NewVendorEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserAboutNewVendor
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
    public function handle($event)
    {
         //A queue system will be the best options for this - but just to show how the listener works, I will use a sync method
         $users = User::all();
         foreach ($users as $value) {
             Mail::to($value->email)->send(new NewVendorEmail);
         }
    }
}
