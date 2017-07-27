<?php

namespace App\Listeners;

use App\Events\Event;
use App\Events\LevelUpEvent;
use App\Services\Status\StudentCreateService;

class LevelUpEventListener
{
    protected $service;
    public function __construct(StudentCreateService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(LevelUpEvent $event)
    {
        \Log::info("fire LevelUpEvent");
        $levelUpPermit = $event->levelUpPermit;
        $this->service->levelUpSkill($levelUpPermit);
    }
}
