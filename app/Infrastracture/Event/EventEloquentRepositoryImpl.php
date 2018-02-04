<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/04
 * Time: 8:25
 */

namespace App\Infrastracture\Event;


use App\Domain\Event\Event;
use App\Domain\Event\EventRepositoryInterface;
use App\Domain\Event\ValueObjects\EventId;
use App\DomainUtility\RandomStringGenerator;
use App\Eloquents\EventEloquent;

class EventEloquentRepositoryImpl implements EventRepositoryInterface
{
    public function save(Event $event): bool
    {
        EventEloquent::saveDomainObject($event);
        return true;
    }

    public function all(): array
    {
        $eventModels = EventEloquent::all();

        $eventCollection = $eventModels->map(function(EventEloquent $eloquent) {
            return $eloquent->toEntity();
        });
        return $eventCollection->toArray();
    }

    public function findById(string $code): ?Event
    {
        return null_safety(EventEloquent::findById($code), function(EventEloquent $eloquent){
            return $eloquent->toEntity();
        });
    }

    public function nextId(): EventId
    {
        do{
            $randId = RandomStringGenerator::makeLowerCase(4);
        }while(!is_null(EventEloquent::findById($randId)));

        $id = new EventId($randId);

        return $id;
    }
}