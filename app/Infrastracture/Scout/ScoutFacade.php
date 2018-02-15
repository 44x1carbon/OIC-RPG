<?php

namespace App\Infrastracture\Scout;

use App\ApplicationService\ScoutAppService;
use App\Domain\GuildMember\ValueObjects\StudentNumber;

class ScoutFacade
{
    function __construct(ScoutAppService $service)
    {
        $this->service = $service;
    }

    public function sendScout(string $from, string $to, string $partyId, string $message)
    {
        $this->service->sendScout(
            new StudentNumber($from),
            new StudentNumber($to),
            $partyId,
            $message
        );
    }
}