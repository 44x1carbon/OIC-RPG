<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/31
 * Time: 13:22
 */

namespace App\Infrastracture\Skill;

use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;
use App\Domain\Skill\Spec\SkillSpec;

class SkillOnMemoryRepositoryImpl implements SkillRepositoryInterface
{
    private $data = [];

    public function findBySkillId(String $skillId): ?Skill
    {
        $result = array_filter($this->data, function(Skill $skill) use($skillId){
            return $skill->skillId() == $skillId;
        });

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function findBySkillName(String $skillName): ?Skill
    {
        $result = array_filter($this->data, function(Skill $skill) use($skillName){
            return $skill->skillName() == $skillName;
        });

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(Skill $skill): bool
    {
        $this->data[] = $skill;
        return true;
    }

    public function all(): array
    {
        return $this->data;
    }
}