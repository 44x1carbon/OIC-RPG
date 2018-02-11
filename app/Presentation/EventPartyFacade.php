<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/12
 * Time: 6:42
 */

namespace App\Presentation;


use App\ApplicationService\EventPartyAppService;
use App\Domain\Event\ValueObjects\EventId;

class EventPartyFacade
{
    protected $eventPartyAppService;

    public function __construct(EventPartyAppService $appService)
    {
        $this->eventPartyAppService = $appService;
    }

    public function joinEvent(string $eventId, string $partyId): bool
    {
        $result = $this->eventPartyAppService->joinEvent(new EventId($eventId), $partyId);

        return $result;
    }
}