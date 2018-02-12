<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/04
 * Time: 10:28
 */

namespace App\Presentation;


use App\ApplicationService\EventAppService;
use App\Domain\Event\ValueObjects\EvaluationPeriod;
use App\Domain\Event\ValueObjects\EventHoldPeriod;
use App\Domain\Event\ValueObjects\EventId;
use App\Domain\Event\ValueObjects\ReleasePeriod;

class EventFacade
{
    protected $eventAppService;

    public function __construct(EventAppService $appService)
    {
        $this->eventAppService = $appService;
    }

    public function issueEvent(
        string $name,
        string $theme,
        string $description,
        string $releaseStartDate,
        string $releaseEndDate,
        string $holdStartDate,
        string $holdEndDate,
        string $evaluationStartDate,
        string $evaluationEndDate
    ): string
    {
        $id = $this->eventAppService->issueEvent(
            $name,
            $theme,
            $description,
            new ReleasePeriod(new \DateTime($releaseStartDate), new \DateTime($releaseEndDate)),
            new EventHoldPeriod(new \DateTime($holdStartDate), new \DateTime($holdEndDate)),
            new EvaluationPeriod(new \DateTime($evaluationStartDate), new \DateTime($evaluationEndDate))
        );
        return $id->code();
    }

    public function ranking(string $eventId, string $partyId, $rank): string
    {
        $id = $this->eventAppService->ranking(new EventId($eventId), $partyId, $rank);

        return $id;
    }

    public function getRanking(string $eventId): array
    {
        return $this->eventAppService->getRanking(new EventId($eventId));
    }
}