<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/02
 * Time: 19:22
 */

namespace App\Domain\Event\Spec;


use App\Domain\Event\Event;
use App\Domain\Event\ValueObjects\EvaluationPeriod;
use App\Domain\Event\ValueObjects\EventHoldPeriod;
use App\Domain\Event\ValueObjects\ReleasePeriod;
use App\DomainUtility\SpecTrait;
use Carbon\Carbon;
use DateTime;

class EventSpec
{
    use SpecTrait;

    const DATE_FORMAT = 'Y-m-d';

    public static function allValidate(Event $event): bool
    {
        if(!self::validateWhetherWithinReleasePeriod($event->releasePeriod(), $event->eventHoldPeriod()->startDate())) return false;
        if(!self::validateWhetherWithinReleasePeriod($event->releasePeriod(), $event->eventHoldPeriod()->endDate())) return false;
        if(!self::validateWhetherWithinReleasePeriod($event->releasePeriod(), $event->evaluationPeriod()->startDate())) return false;
        if(!self::validateWhetherWithinReleasePeriod($event->releasePeriod(), $event->evaluationPeriod()->endDate())) return false;
        if(!self::validateEndedEventHoldPeriod($event->eventHoldPeriod(), $event->evaluationPeriod())) return false;
        return true;
    }

    public static function validateWhetherWithinReleasePeriod(ReleasePeriod $releasePeriod, DateTime $date): bool
    {
        $_startDate = new Carbon($releasePeriod->startDate()->format(self::DATE_FORMAT));
        $_endDate = new Carbon($releasePeriod->endDate()->format(self::DATE_FORMAT));
        $_date = new Carbon($date->format(self::DATE_FORMAT));
        return $_date->between($_startDate, $_endDate);
    }

    public static function validateEndedEventHoldPeriod(EventHoldPeriod $eventHoldPeriod, EvaluationPeriod $evaluationPeriod): bool
    {
        return $eventHoldPeriod->endDate() < $evaluationPeriod->startDate();
    }
}