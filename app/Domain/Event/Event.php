<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/01/30
 * Time: 17:37
 */

namespace App\Domain\Event;


use Faker\Provider\DateTime;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\VarDumper\Caster\DateCaster;

class Event
{
    private $id;
    private $name;
    private $theme;
    private $description;
    private $releaseStartDate;
    private $eventHoldPeriod;
    private $evaluationPeriod;

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

    public function releaseStartDate(): DateTime
    {
        return $this->releaseStartDate;
    }

    public function eventHoldPeriod(): EventHoldPeriod
    {
        return $this->eventHoldPeriod;
    }

    public function evaluationPeriod(): EvalutionPeriod
    {
        return $this->evaluationPeriod;
    }
}