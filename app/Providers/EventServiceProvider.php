<?php

namespace App\Providers;

use App\Events\AssetAssigned;
use App\Events\NewAssetAdded;
use App\Events\NewUserAdded;
use App\Events\NewVendorAdded;
use App\Listeners\AssetAssigned as ListenersAssetAssigned;
use App\Listeners\NotifyAdmin;
use App\Listeners\NotifyUserAboutNewAsset;
use App\Listeners\NotifyUserAboutNewVendor;
use App\Listeners\SendWelcomeEmailToNewUser;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        NewUserAdded::class => [
            SendWelcomeEmailToNewUser::class,
            NotifyAdmin::class,
        ],
        NewAssetAdded::class=>[
            NotifyUserAboutNewAsset::class
        ],
        NewVendorAdded::class=>[
            NotifyUserAboutNewVendor::class
        ],
        AssetAssigned::class=>[
            ListenersAssetAssigned::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
