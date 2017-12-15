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

class ActivityEndDateSpec
{
    use SpecTrait;

    // UnixTime形式であるか、現在より後の時間が指定されているかをチェック
    public static function allValidate(int $timeStamp) :bool
    {
        if(!self::isUnixTimeFormat($timeStamp)) return false;
        if(!self::isAfterNow($timeStamp)) return false;
        return true;
    }

    // UnixTime形式か判別
    public static function isUnixTimeFormat(int $timeStamp): bool
    {
        return $timeStamp >= 0;
    }

    // 現在より後の時間が指定されているかチェック
    public  static function isAfterNow(int $timeStamp): bool
    {
        return time() < $timeStamp;
    }
}