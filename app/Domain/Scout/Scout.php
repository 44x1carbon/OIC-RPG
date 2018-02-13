<?php

namespace App\Domain\Scout;


use App\Domain\GuildMember\ValueObjects\StudentNumber;

class Scout
{
    function __construct(string $id, StudentNumber $from, StudentNumber $to, string $partyId, string $message, \DateTime $send_at)
    {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
        $this->partyId = $partyId;
        $this->message = $message;
        $this->send_at = $send_at;
    }
}