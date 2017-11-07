<?php

namespace App\Infrastracture\PossessionSkill;

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

    public function findByPossessionSkill(Skill $skill): ?PossessionSkill
    {
        $result = array_filter($this->data, function(PossessionSkill $possessionSkill) use($skill){
            return $possessionSkill->skill()->skillId() == $skill->skillId();
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