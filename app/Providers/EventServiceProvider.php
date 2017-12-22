<?php

namespace App\Providers;

use App\Events\AddExpEvent;
use App\Events\LevelUpEvent;
use App\Listeners\AddExpEventListener;
use App\Listeners\LevelUpEventListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\AddExpEvent' => [
            'App\Listeners\AddExpEventListener',
        ],
        'App\Events\LevelUpEvent' => [
            'App\Listeners\LevelUpEventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
