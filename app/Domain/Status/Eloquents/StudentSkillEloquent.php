<?php

namespace App\Domain\Status\Eloquents;

use App\Domain\Status\Entity\Student;
use App\Domain\Status\Entity\StudentSkill;
use App\Domain\Status\ValueObject\StudentSkillInfo;
use App\Utilities\SkillExpDictionary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class StudentSkillEloquent extends Model
{
    protected $table = "student_skills";
    protected $guarded = [];

    public function scopeWhereSkillCode(Builder $query, string $code):Builder
    {
        return $query->where("skill_code", $code);
    }

    public function skill()
    {
        return $this->belongsTo(SkillEloquent::class, 'skill_id');
    }

    public function student()
    {
        return $this->belongsTo(StudentEloquent::class, 'student_id');
    }

    public function makeForSkillModel(SkillEloquent $skillModel): StudentSkillEloquent
    {
        return new static([
            "skill_id" =>  $skillModel->id,
            "level" => 1,
            "exp" => 0,
            "next_exp" => SkillExpDictionary::getNeedExp(1),
        ]);
    }

    public function toValueObject():StudentSkillInfo
    {
        return new StudentSkillInfo([
            "skillCode" => $this->skill->skill_code,
            "name" => $this->skill->name,
            "memo" =>  $this->skill->memo,
            "level" => $this->level,
            "exp" => $this->exp,
            "nextExp" => $this->next_exp,
        ]);
    }

    public function toEntity():StudentSkill
    {
        $scope = [
            StudentSkill::SCOPE_INFO => $this->toValueObject()
        ];

        return new StudentSkill($this->id, $scope);
    }

    public function fromEntity(StudentSkill $skill):StudentSkillEloquent
    {
        return self::find($skill->getId());
    }
}
