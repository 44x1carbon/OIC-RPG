<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/12
 * Time: 3:46
 */

namespace App\Domain\EventParty;


use App\Domain\Event\ValueObjects\EventId;

class EventParty
{
    private $eventId;
    private $partyId;
    private $workName;
    private $workIntroduction;
    private $rank;

    public function __construct(EventId $eventId, string $partyId, string $workName = null, string $workIntroduction = null, int $rank = null)
    {
        $this->eventId = $eventId;
        $this->partyId = $partyId;
        $this->workName = $workName;
        $this->workIntroduction = $workIntroduction;
        $this->rank = $rank;
    }

    public function eventId(): EventId
    {
        return $this->eventId;
    }

    public function partyId(): string
    {
        return $this->partyId;
    }

    public function workName(): ?string
    {
        return $this->workName;
    }

    public function workIntroduction(): ?string
    {
        return $this->workIntroduction;
    }

    public function rank(): ?int
    {
        return $this->rank;
    }

    public function setWorkName(string $name)
    {
        $this->workName = $name;
    }

    public function setWorkIntroduction(string $introduction)
    {
        $this->workIntroduction = $introduction;
    }

    public function setRank(int $rank)
    {
        $this->rank = $rank;
    }

    public function updateWork(string $workName = null, string $workIntroduction = null)
    {
        if(!is_null($workName)) $this->setWorkName($workName);
        if(!is_null($workIntroduction)) $this->setWorkIntroduction($workIntroduction);
    }
}