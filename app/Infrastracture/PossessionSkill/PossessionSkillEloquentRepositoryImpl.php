<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/15
 * Time: 15:06
 */

namespace App\Infrastracture\PossessionSkill;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\Skill\Skill;
use App\Eloquents\PossessionSkillEloquent;

class PossessionSkillEloquentRepositoryImpl implements PossessionSkillRepositoryInterface
{
    public function findBySkillAndStudentNumber(string $skillId, StudentNumber $studentNumber): ?PossessionSkill
    {
        $possessionSkillModel = PossessionSkillEloquent::findBySkillAndStudentNumber($skillId, $studentNumber);
        return null_safety($possessionSkillModel, function(PossessionSkillEloquent $eloquent){
            return $eloquent->toEntity();
        });
    }

    public function save(PossessionSkill $possessionSkill, StudentNumber $studentNumber): bool
    {
        return PossessionSkillEloquent::saveDomainObject($possessionSkill, $studentNumber);
    }
}