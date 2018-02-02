<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/02
 * Time: 16:07
 */

namespace App\Domain\Event\ValueObjects;


use DateTime;

class EvaluationPeriod
{
    private $startDate;
    private $endDate;

    public function __construct(string $startDate, string $endDate)
    {
        $this->startDate = new DateTime($startDate);
        $this->endDate = new DateTime($endDate);
    }

    public function startDate(): DateTime
    {
        return $this->startDate;
    }

    public function endDate(): DateTime
    {
        return $this->endDate;
    }
}