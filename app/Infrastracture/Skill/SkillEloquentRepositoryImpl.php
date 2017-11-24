<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/24
 * Time: 15:58
 */

namespace App\Infrastracture\Skill;


use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;
use App\Eloquents\SkillEloquent;

class SkillEloquentRepositoryImpl implements SkillRepositoryInterface
{
    public function findBySkillId(String $skillId): ?Skill
    {
        // TODO: Implement findBySkillId() method.
    }

    public function save(Skill $skill): bool
    {
        // TODO: Implement save() method.
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }
}