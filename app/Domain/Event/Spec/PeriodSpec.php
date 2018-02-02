<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/02/02
 * Time: 16:11
 */

namespace App\Domain\Event\Spec;


use App\Domain\Event\ValueObjects\ReleasePeriod;
use App\DomainUtility\SpecTrait;
use Carbon\Carbon;
use DateTime;

class PeriodSpec
{
    use SpecTrait;

    public static function allValidate(DateTime $startDate, DateTime $endDate): bool
    {
        if(!self::isAfterNow($startDate)) return false;
        if(!self::isAfterNow($endDate)) return false;
        if(!self::isAfterStartDate($startDate, $endDate)) return false;
        return true;
    }

    //現在より後の日付か
    public static function isAfterNow(DateTime $date): bool
    {
        return (new Carbon($date->format('Y-m-d')))->gte(Carbon::today());
    }

    //endDateはstartDateより後か
    public static function isAfterStartDate(DateTime $startDate, DateTime $endDate): bool
    {
        $_startDate = new Carbon($startDate->format('Y-m-d'));
        $_endDate = new Carbon($endDate->format('Y-m-d'));
        return $_startDate->lt($_endDate);
    }
}