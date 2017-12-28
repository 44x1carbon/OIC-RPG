<?php

namespace App\Domain\Party\ValueObjects;

use App\Domain\GuildMember\ValueObjects\StudentNumber;

class PartyMember
{
    private $assigneeRoleName;
    private $memberId;
    private $memberName;

    function __construct(string $roleName, StudentNumber $memberId, string $memberName)
    {
        $this->assigneeRoleName = $roleName;
        $this->memberId = $memberId;
        $this->memberName = $memberName;
    }

    /**
     * @return string
     */
    public function assigneeRoleName(): string
    {
        return $this->assigneeRoleName;
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
    public function memberName(): string
    {
        return $this->memberName;
    }
}