<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/12
 * Time: 4:09
 */

namespace App\Infrastracture\EventParty;


use App\Domain\Event\ValueObjects\EventId;
use App\Domain\EventParty\EventParty;
use App\Domain\EventParty\EventPartyRepositoryInterface;
use App\Eloquents\EventPartyEloquent;

class EventPartyEloquentRepositoryImpl implements EventPartyRepositoryInterface
{
    public function save(EventParty $eventParty): bool
    {
        EventPartyEloquent::saveDomainObject($eventParty);
        return true;
    }

    public function findByEventId(EventId $id): array
    {
        return EventPartyEloquent::findByEventId($id->code());
    }

    public function findByEventIdAndPartyId(EventId $eventId, string $partyId): ?EventParty
    {
        return null_safety(EventPartyEloquent::findByEventIdAndPartyId($eventId->code(), $partyId), function(EventPartyEloquent $eloquent){
            return $eloquent->toEntity();
        });
    }
}