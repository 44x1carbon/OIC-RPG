<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/15
 * Time: 15:14
 */

namespace App\Eloquents;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Domain\Skill\Skill;
use Illuminate\Database\Eloquent\Model;

class PossessionSkillEloquent extends Model
{
    protected $table = 'possession_skills';

    public static function findByStudentNumber(StudentNumber $studentNumber): ?array
    {
        $possessionSkillModels = self::where('student_number', $studentNumber->code())->get();
        $possessionSkillCollection = $possessionSkillModels->map(function(PossessionSkillEloquent $eloquent){
            return $eloquent->toEntity();
        });
        return $possessionSkillCollection->toArray();
    }

    public static function findBySkillAndStudentNumber(string $skillId, StudentNumber $studentNumber): ?PossessionSkillEloquent
    {
        $possessionSkillModel = self::where('skill_id', $skillId)->where('student_number', $studentNumber->code())->first();
        return $possessionSkillModel;
    }

    public static function fromEntity(PossessionSkill $possessionSkill, StudentNumber $studentNumber): PossessionSkillEloquent
    {
        $possessionSkillModel = self::findBySkillAndStudentNumber($possessionSkill->skillId(), $studentNumber);
        if(is_null($possessionSkillModel)) $possessionSkillModel = new PossessionSkillEloquent();

        $possessionSkillModel->student_number = $studentNumber->code();
        $possessionSkillModel->skill_id = $possessionSkill->skillid();
        $possessionSkillModel->skill_level = $possessionSkill->skillLevel();
        $possessionSkillModel->total_exp = $possessionSkill->totalExp();

        return $possessionSkillModel;
    }

    public function toEntity(): PossessionSkill
    {
        $studentNumber = new StudentNumber($this->student_number);

        $entity = new PossessionSkill(
            $studentNumber,
            $this->skill_id,
            $this->skill_level,
            $this->total_exp
        );

        return $entity;
    }

    public static function saveManyDomainObject(PossessionSkillCollection $possessionSkillCollection, StudentNumber $studentNumber): bool
    {
        foreach ((array)$possessionSkillCollection as $possessionSkill)
        {
            $possessionSkillModel = self::fromEntity($possessionSkill, $studentNumber);
            $possessionSkillModel->save();
        }
        return true;
    }
}