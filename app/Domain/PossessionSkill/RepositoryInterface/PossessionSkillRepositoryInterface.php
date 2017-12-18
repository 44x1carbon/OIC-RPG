<?php

namespace App\Domain\PossessionSkill\RepositoryInterface;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\Skill\Skill;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 13:01
 */

interface PossessionSkillRepositoryInterface
{
    public function findBySkillAndStudentNumber(string $skillId, StudentNumber $studentNumber): ?PossessionSkill;

    public function save(PossessionSkill $possessionSkill, StudentNumber $studentNumber): bool;
}