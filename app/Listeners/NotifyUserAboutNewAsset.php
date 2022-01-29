<?php

namespace App\Listeners;

use App\Mail\NewAssetEmail;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUserAboutNewAsset
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
            Mail::to($value->email)->send(new NewAssetEmail);
        }
        
    }
}
