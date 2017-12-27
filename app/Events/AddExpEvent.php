<?php

namespace App\Events;

use App\Domain\PossessionSkill\PossessionSkill;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AddExpEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $possessionSkill;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PossessionSkill $possessionSkill)
    {
        $this->possessionSkill = $possessionSkill;
    }

}
