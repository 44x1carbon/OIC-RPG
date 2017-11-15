<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/10
 * Time: 13:07
 */

namespace App\Domain\PossessionSkill;


class AddProcess
{
    const LEVEL_UP_INTERVAL = 100;

    public static function addExp(PossessionSkill $beforePossessionSkill,int $exp): PossessionSkill
    {
        $afterPossessionSkill = $beforePossessionSkill->clone();
        $afterPossessionSkill->setTotalExp($beforePossessionSkill->totalExp() + $exp);

        $levelUpValue = self::levelUp($beforePossessionSkill, $afterPossessionSkill);
        $afterPossessionSkill->setSkillLevel($afterPossessionSkill->skillLevel() + $levelUpValue);

        return $afterPossessionSkill;
    }

    public static function levelUp(PossessionSkill $beforePossessionSkill, PossessionSkill $afterPossessionSkill): int
    {
        $beforeTotalExp = $beforePossessionSkill->totalExp();
        $afterTotalExp = $afterPossessionSkill->totalExp();
        $exp = $afterTotalExp - $beforeTotalExp;

        return (int) floor(($beforeTotalExp % self::LEVEL_UP_INTERVAL + $exp) / self::LEVEL_UP_INTERVAL);
    }
}