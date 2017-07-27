<?php

namespace App\Events;

use App\Domain\Status\Entity\StudentSkill;
use App\Domain\Status\ValueObject\LevelUpPermit;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class LevelUpEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $levelUpPermit;

    public function __construct(LevelUpPermit $permit)
    {
        $this->levelUpPermit = $permit;
    }
}
