<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/24
 * Time: 16:02
 */

namespace App\Domain\Party\Spec;

use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\DomainUtility\SpecTrait;
use Carbon\Carbon;

class ActivityEndDateSpec
{
    use SpecTrait;

    public static function allValidate(ActivityEndDate $activityEndDate) :bool
    {
        if(!self::isAfterNow($activityEndDate)) return false;
        return true;
    }

    // 現在より後の時間が指定されているかチェック
    public  static function isAfterNow(ActivityEndDate $activityEndDate): bool
    {
        return (new Carbon($activityEndDate->date()->format('Y-m-d')))->gte(Carbon::today());
    }
}