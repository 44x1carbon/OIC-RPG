<?php

namespace App\Domain\PossessionSkill\Factory;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
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
    public function createPossessionSkill(string $skillId, StudentNumber $studentNumber): PossessionSkill
    {
        $possessionSkill = new PossessionSkill(
            $studentNumber,
            $skillId,
            1,
            0
        );
        return $possessionSkill;
    }
}