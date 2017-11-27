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
    protected $eloquent;

    public function __construct(SkillEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function findBySkillId(String $skillId): ?Skill
    {
        $skillModel = $this->eloquent->findBySkillId($skillId);
        if(is_null($skillModel)) return null;
        return $skillModel->toEntity();
    }

    public function save(Skill $skill): bool
    {
        $skillModel = $this->eloquent->findBySkillId($skill->skillId());
        if(is_null($skillModel)) $skillModel = new $this->eloquent();

        $skillModel->skill_id = $skill->skillId();
        $skillModel->name = $skill->skillName();

        return $skillModel->save();
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }
}