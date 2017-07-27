<?php

namespace App\Events;

use App\Domain\Status\Entity\StudentSkill;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AddExpEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $studentSkill;

    public function __construct(StudentSkill $studentSkill)
    {
        $this->studentSkill = $studentSkill;
    }
}
