<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/22
 * Time: 19:00
 */

namespace App\Domain\GetCondition\Spec;


class GetConditionSpec
{
    const LOWEST_VALUE = 0;

    public static function validateValue(int $value): bool
    {
        return $value >= self::LOWEST_VALUE;
    }
}