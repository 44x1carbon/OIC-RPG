<?php

namespace App\Domain\PossessionSkill\Factory;

use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\Skill\Skill;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 14:20
 */

class PossessionSkillFactory
{
    public function createPossessionSkill(Skill $skill): PossessionSkill
    {
        $possessionSkill = new PossessionSkill();
        $possessionSkill->setSkill($skill);
        $possessionSkill->setSkillLevel(1);
        $possessionSkill->setTotalExp(0);
        return $possessionSkill;
    }
}