<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/01/30
 * Time: 17:37
 */

namespace App\Domain\Event;


use App\Domain\Event\ValueObjects\EvaluationPeriod;
use App\Domain\Event\ValueObjects\EventHoldPeriod;
use App\Domain\Event\ValueObjects\EventId;
use App\Domain\Event\ValueObjects\ReleasePeriod;
use Faker\Provider\DateTime;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\VarDumper\Caster\DateCaster;

class Event
{
    private $id;
    private $name;
    private $theme;
    private $description;
    private $releasePeriod;
    private $eventHoldPeriod;
    private $evaluationPeriod;

    public function __construct(
        EventId $id,
        string $name,
        string $theme,
        string $description,
        ReleasePeriod $releasePeriod,
        EventHoldPeriod $eventHoldPeriod,
        EvaluationPeriod $evaluationPeriod
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->theme = $theme;
        $this->description = $description;
        $this->releasePeriod = $releasePeriod;
        $this->eventHoldPeriod = $eventHoldPeriod;
        $this->evaluationPeriod = $evaluationPeriod;
    }

    public function id(): EventId
    {
        return $this->id;
    }

    public function name(): String
    {
        return $this->name;
    }

    public function theme(): String
    {
        return $this->theme;
    }

    public function description(): String
    {
        return $this->description;
    }

    public function releasePeriod(): ReleasePeriod
    {
        return $this->releasePeriod;
    }

    public function eventHoldPeriod(): EventHoldPeriod
    {
        return $this->eventHoldPeriod;
    }

    public function evaluationPeriod(): EvaluationPeriod
    {
        return $this->evaluationPeriod;
    }
}