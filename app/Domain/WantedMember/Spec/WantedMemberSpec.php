<?php

namespace App\Domain\WantedMember\Spec;

use App\Domain\WantedMember\ValueObjects\WantedStatus;
use App\Domain\WantedMember\WantedMember;
use App\DomainUtility\SpecTrait;

class WantedMemberSpec
{
    use SpecTrait;

    /*
     * 公開状態か
     */
    public static function isOpenStatus(WantedMember $wantedMember): bool
    {
        return $wantedMember->wantedStatus() == new WantedStatus(WantedStatus::OPEN);
    }

    /*
     * 担当者が決まっているか
     */
    public static function isAssigned(WantedMember $wantedMember): bool
    {
        return !is_null($wantedMember->officerId());
    }

    /*
     * 担当者を割り当て可能か
     */
    public static function isAssignable(WantedMember $wantedMember): bool
    {
        return self::isOpenStatus($wantedMember) && !self::isAssigned($wantedMember);
    }
}