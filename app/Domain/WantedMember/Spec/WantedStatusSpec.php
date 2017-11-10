<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 15:18
 */

namespace App\Domain\WantedMember\Spec;

use App\Domain\WantedMember\ValueObjects\WantedStatus;
use App\DomainUtility\SpecTrait;

class WantedStatusSpec
{
    use SpecTrait;

    public static function isAvailable(String $status): bool
    {
        $list = WantedStatus::STATUS_LIST;
        return in_array($status, $list);
    }
}