<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/04
 * Time: 10:42
 */

namespace App\ApplicationService;


use App\Domain\Event\Event;
use App\Domain\Event\EventRepositoryInterface;
use App\Domain\Event\Spec\EventSpec;
use App\Domain\Event\Spec\PeriodSpec;
use App\Domain\Event\ValueObjects\EvaluationPeriod;
use App\Domain\Event\ValueObjects\EventHoldPeriod;
use App\Domain\Event\ValueObjects\EventId;
use App\Domain\Event\ValueObjects\ReleasePeriod;
use App\Exceptions\DomainException;

class EventAppService
{
    protected $repo;

    public function __construct(EventRepositoryInterface $repository)
    {
        $this->repo = $repository;
    }

    public function issueEvent(
        string $name,
        string $theme,
        string $description,
        ReleasePeriod $releasePeriod,
        EventHoldPeriod $eventHoldPeriod,
        EvaluationPeriod $evaluationPeriod
    ): EventId
    {
        if(!PeriodSpec::allValidate($releasePeriod->startDate(), $releasePeriod->endDate())) throw new DomainException('Error');
        if(!PeriodSpec::allValidate($eventHoldPeriod->startDate(), $eventHoldPeriod->endDate())) throw new DomainException('Error');
        if(!PeriodSpec::allValidate($evaluationPeriod->startDate(), $evaluationPeriod->endDate())) throw new DomainException('Error');

        $event = new Event(
            $this->repo->nextId(),
            $name,
            $theme,
            $description,
            $releasePeriod,
            $eventHoldPeriod,
            $evaluationPeriod
        );

        if(!EventSpec::allValidate($event)) throw new DomainException('設定期間が誤っています');

        $this->repo->save($event);

        return $event->id();
    }
}