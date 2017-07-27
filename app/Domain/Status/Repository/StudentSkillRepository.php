<?php

namespace App\Domain\Status\Repository;

use App\Domain\Status\Eloquents\SkillEloquent;
use App\Domain\Status\Eloquents\StudentSkillEloquent;
use App\Domain\Status\Entity\StudentSkill;
use App\Domain\Status\ValueObject\StudentSkillInfo;
use App\Utilities\SkillExpDictionary;

class StudentSkillRepository
{
    protected $studentSkillModel;
    protected $skillRepo;

    function __construct(StudentSkillEloquent $studentSkillEloquent, SkillRepository $skillRepo)
    {
        $this->studentSkillModel = $studentSkillEloquent;
        $this->skillRepo = $skillRepo;
    }

    public function makeForSkillModel(SkillEloquent $skillModel): StudentSkillEloquent
    {
        return new $this->studentSkillModel([
            "skill_id" =>  $skillModel->id,
            "level" => 1,
            "exp" => 0,
            "next_exp" => SkillExpDictionary::getNeedExp(1),
        ]);
    }

    public function update(StudentSkill $studentSkill, StudentSkillInfo $info):StudentSkill
    {
        $model = $this->studentSkillModel->fromEntity($studentSkill);
        $model->update([
            "level" => $info->level,
            "exp" => $info->exp,
            "next_exp" => $info->nextExp
        ]);

        return $model->toEntity();
    }
}