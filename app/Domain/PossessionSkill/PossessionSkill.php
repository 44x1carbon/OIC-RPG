<?php

namespace App\Domain\PossessionSkill;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Skill\Skill;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 12:41
 */

class PossessionSkill
{
    const LEVEL_UP_INTERVAL = 100;

    private $studentNumber;
    private $skill;
    private $skillLevel;
    private $totalExp;

    public function __construct()
    {
    }

    public function setStudentNumber(StudentNumber $studentNumber)
    {
        $this->studentNumber = $studentNumber;
    }

    public function setSkill(Skill $skill)
    {
        $this->skill = $skill;
    }

    public function setSkillLevel(int $skillLevel)
    {
        $this->skillLevel = $skillLevel;
    }

    public function setTotalExp(int $totalExp)
    {
        $this->totalExp = $totalExp;
    }

    public function studentNumber(): StudentNumber
    {
        return $this->studentNumber;
    }

    public function skill(): Skill
    {
        return $this->skill;
    }

    public function skillLevel(): int
    {
        return $this->skillLevel;
    }

    public function totalExp(): int
    {
        return $this->totalExp;
    }

    public function clone(): PossessionSkill
    {
        return clone $this;
    }

    public static function levelUp(PossessionSkill $beforePossessionSkill, PossessionSkill $afterPossessionSkill): PossessionSkill
    {
        $beforeTotalExp = $beforePossessionSkill->totalExp();
        $afterTotalExp = $afterPossessionSkill->totalExp();

        $exp = $afterTotalExp - $beforeTotalExp;

        $levelUpValue = (int) floor(($beforeTotalExp % self::LEVEL_UP_INTERVAL + $exp) / self::LEVEL_UP_INTERVAL);
        $afterPossessionSkill->setSkillLevel($afterPossessionSkill->skillLevel() + $levelUpValue);

        return $afterPossessionSkill;
    }
}