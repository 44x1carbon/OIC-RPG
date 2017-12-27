<?php

namespace App\Listeners;

use App\Events\AddExpEvent;
use App\Events\LevelUpEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class AddExpEventListener
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(AddExpEvent $event)
    {

    }
}
