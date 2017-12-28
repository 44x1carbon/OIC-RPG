<?php

namespace App\Domain\Party\ValueObjects;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\WantedRole\WantedRole;

class PartyMemberInfo
{
    private $assigneeRole;
    private $memberId;
    private $partyId;

    function __construct(WantedRole $role, StudentNumber $memberId, string $partyId)
    {
        $this->assigneeRole = $role;
        $this->memberId = $memberId;
        $this->partyId = $partyId;
    }

    /**
     * @return WantedRole
     */
    public function assigneeRole(): WantedRole
    {
        return $this->assigneeRole;
    }

    /**
     * @return StudentNumber
     */
    public function memberId(): StudentNumber
    {
        return $this->memberId;
    }

    /**
     * @return string
     */
    public function partyId(): string
    {
        return $this->partyId;
    }
}