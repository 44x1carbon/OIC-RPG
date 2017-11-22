<?php

namespace App\Infrastracture\PossessionSkill;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\Skill\Skill;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/07
 * Time: 12:58
 */

class PossessionSkillOnMemoryRepositoryImpl implements PossessionSkillRepositoryInterface
{
    private $data = [];

    public function findBySkillAndStudentNumber(Skill $skill, StudentNumber $studentNumber): ?PossessionSkill
    {
        $result = array_filter($this->data, function($possessionSKill) use($skill, $studentNumber){
            /* @var PossessionSkill $possessionSKill*/
            return $possessionSKill->studentNumber()->code() === $studentNumber->code() &&
                $possessionSKill->skill()->skillId() === $skill->skillId();
        });
        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(PossessionSkill $possessionSkill): bool
    {
        $this->data[] = $possessionSkill;
        return true;
    }

    public function all(): array
    {
        return $this->data;
    }
}