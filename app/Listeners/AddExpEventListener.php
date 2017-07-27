<?php

namespace App\Listeners;

use App\Domain\Status\ValueObject\LevelUpPermit;
use App\Events\AddExpEvent;
use App\Events\Event;
use App\Events\LevelUpEvent;
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
        \Log::info("fire AddExpEvent");
        $studentSkill = $event->studentSkill;
        if($studentSkill->isLevelUp()) {
            $permit = new LevelUpPermit([
                "studentSkill" => $studentSkill
            ]);
            event(new LevelUpEvent($permit));
        }
    }
}
