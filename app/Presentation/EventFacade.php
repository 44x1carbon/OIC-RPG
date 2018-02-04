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
            new ReleasePeriod($releaseStartDate, $releaseEndDate),
            new EventHoldPeriod($holdStartDate, $holdEndDate),
            new EvaluationPeriod($evaluationStartDate, $evaluationEndDate)
        );
        return $id->code();
    }
}