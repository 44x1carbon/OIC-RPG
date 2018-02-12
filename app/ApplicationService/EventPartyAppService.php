<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/12
 * Time: 6:32
 */

namespace App\ApplicationService;


use App\Domain\Event\ValueObjects\EventId;
use App\Domain\EventParty\EventParty;
use App\Domain\EventParty\EventPartyRepositoryInterface;
use App\Domain\EventParty\Spec\EventPartySpec;

class EventPartyAppService
{
    protected $repo;

    public function __construct(EventPartyRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function joinEvent(EventId $eventId, string $partyId): bool
    {
        if(EventPartySpec::isExist($eventId, $partyId)) return false;

        $eventParty = new EventParty($eventId, $partyId);
        return $this->repo->save($eventParty);
    }

    public function updateWork(EventId $eventId, string $partyId, string $workName = null, string $introduction = null): string
    {
        $eventParty = $this->repo->findByEventIdAndPartyId($eventId, $partyId);
        $eventParty->updateWork($workName, $introduction);

        $this->repo->save($eventParty);

        return $eventParty->partyId();
    }
}