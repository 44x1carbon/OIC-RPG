<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/12
 * Time: 4:11
 */

namespace App\Eloquents;


use App\Domain\Event\ValueObjects\EventId;
use App\Domain\EventParty\EventParty;
use Illuminate\Database\Eloquent\Model;

class EventPartyEloquent extends Model
{
    protected $table = 'event_parties';

    public static function findByEventId(string $code): ?array
    {
        $eventPartyModels = self::where('event_id', $code)->get();
        $eventPartyCollection = $eventPartyModels->map(function(EventPartyEloquent $eloquent){
            return $eloquent->toEntity();
        });
        return $eventPartyCollection->toArray();
    }

    public static function findByEventIdAndPartyId(string $eventId, string $partyId): ?EventPartyEloquent
    {
        $eventPartyModel = self::where('event_id', $eventId)->where('party_id', $partyId)->first();
        return $eventPartyModel;
    }

    public function toEntity(): EventParty
    {
        $entity = new EventParty(
            new EventId($this->event_id),
            $this->party_id,
            $this->name,
            $this->introduction,
            $this->rank
        );
        return $entity;
    }

    public static function fromEntity(EventParty $eventParty): EventPartyEloquent
    {
        $eventPartyModel = self::findByEventIdAndPartyId($eventParty->eventId()->code(), $eventParty->partyId());
        if(is_null($eventPartyModel))
        {
            $eventPartyModel = new EventPartyEloquent();
            $eventPartyModel->event_id = $eventParty->eventId()->code();
            $eventPartyModel->party_id = $eventParty->partyId();
        }
        $eventPartyModel->name = $eventParty->workName();
        $eventPartyModel->introduction - $eventParty->workIntroduction();
        $eventPartyModel->rank = $eventParty->rank();

        return $eventPartyModel;
    }

    public static function saveDomainObject(EventParty $eventParty)
    {
        $eventPartyModel = self::fromEntity($eventParty);
        $eventPartyModel->save();
    }
}