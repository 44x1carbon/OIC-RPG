<?php

namespace App\Domain\GuildMember\Spec;

use App\Domain\GuildMember\ValueObjects\MemberSkillStatus;

class MemberSkillStatusSpec
{
    /**
     * インスタンス化できる状態かを判定
     * @param MemberSkillStatus $status
     * @return bool
     */
    public static function canInstantiated(MemberSkillStatus $status): bool
    {
        if($status->status()->isNotLearned()) return self::instantiatedNotLearned($status);
        if($status->status()->isLearned()) return self::instantiatedLearned($status);
    }

    /**
     * インスタンス化できる状態かを判定(未習得時)
     * @param MemberSkillStatus $status
     * @return bool
     */
    public static function instantiatedNotLearned(MemberSkillStatus $status): bool
    {
        return in_array(false, [
            is_null($status->possessionSkill()),
        ]);

    }

    /**
     * インスタンス化できる状態かを判定(習得時)
     * @param MemberSkillStatus $status
     * @return bool
     */
    public static function instantiatedLearned(MemberSkillStatus $status): bool
    {
        return in_array(false, [
            !is_null($status->possessionSkill()),
        ]);

    }
}