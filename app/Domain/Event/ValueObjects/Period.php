<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/07
 * Time: 17:19
 */

namespace App\Domain\Event\ValueObjects;


use DateTime;

abstract class Period
{
    public $startDate;
    public $endDate;

    abstract public function __construct(DateTime $startDate, DateTime $endDate);

    abstract public function startDate(): DateTime;

    abstract public function endDate(): DateTime;
}