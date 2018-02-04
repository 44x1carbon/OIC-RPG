<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/04
 * Time: 8:43
 */

namespace App\Eloquents;


use App\Domain\Event\Event;
use App\Domain\Event\ValueObjects\EvaluationPeriod;
use App\Domain\Event\ValueObjects\EventHoldPeriod;
use App\Domain\Event\ValueObjects\EventId;
use App\Domain\Event\ValueObjects\ReleasePeriod;
use Illuminate\Database\Eloquent\Model;

class EventEloquent extends Model
{
    protected $table = 'events';

    public static function findById(string $code): ?EventEloquent
    {
        $eventModel = self::where('event_id', $code)->first();
        return $eventModel;
    }

    public static function fromEntity(Event $event): EventEloquent
    {
        $eventModel = self::findById($event->id()->code());
        if(is_null($eventModel))
        {
            $eventModel = new EventEloquent();
            $eventModel->event_id = $event->id()->code();
        }
        $eventModel->name = $event->name();
        $eventModel->theme = $event->theme();
        $eventModel->description = $event->description();
        $eventModel->release_start_date = $event->releasePeriod()->startDate();
        $eventModel->release_end_date = $event->releasePeriod()->endDate();
        $eventModel->event_hold_start_date = $event->eventHoldPeriod()->startDate();
        $eventModel->event_hold_end_date = $event->eventHoldPeriod()->endDate();
        $eventModel->evaluation_start_date = $event->evaluationPeriod()->startDate();
        $eventModel->evaluation_end_date = $event->evaluationPeriod()->endDate();

        return $eventModel;
    }

    public static function saveDomainObject(Event $event)
    {
        $eventModel = self::fromEntity($event);
        $eventModel->save();
    }

    public function toEntity(): Event
    {
        $entity = new Event(
            new EventId($this->event_id),
            $this->name,
            $this->theme,
            $this->description,
            new ReleasePeriod($this->release_start_date, $this->release_end_date),
            new EventHoldPeriod($this->event_hold_start_date, $this->event_hold_end_date),
            new EvaluationPeriod($this->evaluation_start_date, $this->evaluation_end_date)
        );
        return $entity;
    }
}