<?php

namespace App\Domain\PossessionSkill;

use App\Domain\Skill\Skill;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 12:41
 */

class PossessionSkill
{
    private $skill;
    private $skillLevel;
    private $totalExp;

    public function __construct()
    {
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
}