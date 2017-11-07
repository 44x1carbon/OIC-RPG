<?php

namespace App\Domain\PossessionSkill\Spec;

use App\Domain\PossessionSkill\PossessionSkill;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 15:06
 */

class AddProcessSpec
{
    public static function addExp(PossessionSkill $possessionSkill,int $exp): PossessionSkill
    {
        $beforeTotalExp = $possessionSkill->totalExp();
        $afterTotalExp = $beforeTotalExp + $exp;
        $possessionSkill->setTotalExp($beforeTotalExp + $exp);

        $levelUpValue = self::levelUp($beforeTotalExp, $afterTotalExp);
        $possessionSkill->setSkillLevel($possessionSkill->skillLevel() + $levelUpValue);

        return $possessionSkill;
    }

    public static function levelUp(int $beforeTotalExp, int $afterTotalExp): int
    {
        $levelUpValue = 0;
        return $levelUpValue;
    }
}