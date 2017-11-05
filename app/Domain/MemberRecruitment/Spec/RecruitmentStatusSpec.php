<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 15:18
 */

namespace App\Domain\MemberRecruitment\Spec;

use App\Domain\MemberRecruitment\ValueObjects\RecruitmentStatus;
use App\DomainUtility\SpecTrait;

class RecruitmentStatusSpec
{
    use SpecTrait;

    public static function isAvailable(String $status): bool
    {
        $list = RecruitmentStatus::STATUS_LIST;
        return in_array($status, $list);
    }
}