<?php

namespace App\Events;

use App\Domain\PossessionSkill\PossessionSkill;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class LevelUpEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $levelUpValue;

    public function __construct(PossessionSkill $possessionSkill)
    {
        $this->levelUpValue = $possessionSkill->skillLevel();
    }
}
