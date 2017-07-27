<?php

namespace Tests\Service\Status;

use App\Domain\Status\Eloquents\StudentEloquent;
use App\Domain\Status\Entity\Student;
use App\Domain\Status\Entity\StudentSkill;

trait SampleFactoryTrait
{
    public function sampleStudent():Student
    {
        $studentModel = StudentEloquent::first();
        if(is_null($studentModel)) throw new \Exception("データを登録してください");
        return $studentModel->toEntity();
    }

    public function sampleStudentSkill(Student $student):StudentSkill
    {
        $studentModel = StudentEloquent::find($student->getId());
        $studentSkillModel = $studentModel->skills()->first();
        if(is_null($studentSkillModel)) throw new \Exception("データを登録してください");

        return $studentSkillModel->toEntity();
    }
}