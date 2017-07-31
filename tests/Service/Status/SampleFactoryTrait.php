<?php

namespace Tests\Service\Status;

use App\Domain\Status\Eloquents\CourseEloquent;
use App\Domain\Status\Eloquents\JobEloquent;
use App\Domain\Status\Eloquents\SkillEloquent;
use App\Domain\Status\Eloquents\StudentEloquent;
use App\Domain\Status\Entity\Course;
use App\Domain\Status\Entity\Job;
use App\Domain\Status\Entity\Skill;
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
        $studentSkillModel = $studentModel->studentSkills()->first();
        if(is_null($studentSkillModel)) throw new \Exception("データを登録してください");

        return $studentSkillModel->toEntity();
    }

    public function sampleJob():Job
    {
        $jobModel = JobEloquent::first();
        if(is_null($jobModel)) throw new \Exception("データを登録してください");
        return $jobModel->toEntity();
    }

    public function sampleSkill():Skill
    {
        $skillModel = SkillEloquent::first();
        if(is_null($skillModel)) throw new \Exception("データを登録してください");
        return $skillModel->toEntity();
    }

    public function sampleCourse():Course
    {
        $model = CourseEloquent::first();
        if(is_null($model)) throw new \Exception("データを登録してください");
        return $model->toEntity();
    }
}