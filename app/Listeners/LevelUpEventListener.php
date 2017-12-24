<?php

namespace App\Listeners;

use App\Events\Event;
use App\Events\LevelUpEvent;
use App\Exceptions\DomainException;
use App\Services\Status\StudentCreateService;

class LevelUpEventListener
{
    public function __construct()
    {

    }

    public function handle(LevelUpEvent $event)
    {

    }
}
