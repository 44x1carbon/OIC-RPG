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
use App\Domain\EventParty\EventPartyRepositoryInterface;
use App\Exceptions\DomainException;

class EventAppService
{
    protected $eventRepo;
    protected $eventPartyRepo;

    public function __construct(EventRepositoryInterface $eventRepo, EventPartyRepositoryInterface $eventPartyRepo)
    {
        $this->eventRepo = $eventRepo;
        $this->eventPartyRepo = $eventPartyRepo;
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
        if(!PeriodSpec::allValidate($releasePeriod)) throw new DomainException('Error');
        if(!PeriodSpec::allValidate($eventHoldPeriod)) throw new DomainException('Error');
        if(!PeriodSpec::allValidate($evaluationPeriod)) throw new DomainException('Error');

        $event = new Event(
            $this->eventRepo->nextId(),
            $name,
            $theme,
            $description,
            $releasePeriod,
            $eventHoldPeriod,
            $evaluationPeriod
        );

        if(!EventSpec::allValidate($event)) throw new DomainException('設定期間が誤っています');

        $this->eventRepo->save($event);

        return $event->id();
    }

    public function ranking(EventId $eventId, string $partyId, int $rank): string
    {
        $eventParty = $this->eventPartyRepo->findByEventIdAndPartyId($eventId, $partyId);
        $eventParty->setRank($rank);

        $this->eventPartyRepo->save($eventParty);

        return $eventParty->partyId();
    }

    public function getRanking(EventId $eventId): array
    {
        return $this->eventPartyRepo->allEventPartyRankingOrderByAsc($eventId);
    }
}