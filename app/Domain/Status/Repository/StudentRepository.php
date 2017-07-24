<?php

namespace App\Domain\Status\Repository;

use App\Domain\Status\Eloquents\SkillEloquent;
use App\Domain\Status\Eloquents\StudentEloquent;
use App\Domain\Status\Entity\Course;
use App\Domain\Status\Entity\Student;
use App\Domain\Status\ValueObject\SkillInfo;
use App\Domain\Status\ValueObject\StudentInfo;
use App\Domain\Status\ValueObject\StudentSkill;
use App\Utilities\SkillExpDictionary;

class StudentRepository
{
    protected $studentModel;
    protected $skillModel;

    function __construct(StudentEloquent $studentModel, SkillEloquent $skillModel)
    {
        $this->studentModel = $studentModel;
        $this->skillModel = $studentModel;
    }

    function create(StudentInfo $studentInfo, Course $course):Student
    {
        $data = [
            "name" => $studentInfo->name,
            "student_code" => $studentInfo->studentCode,
            "belong_class" => $studentInfo->belongClass,
            "belong_course_id" => $course->getId()
        ];

        $studentModel = $this->studentModel->create($data);

        return $studentModel->toEntity();
    }

    function addSkill(Student $student, SkillInfo $skillInfo):SkillInfo
    {
        $studentModel = $this->studentModel->fromEntity($student);
        $skillModel = $this->skillModel->findCode($skillInfo->skillCode);

        $studentModel->skills()->save($skillModel, [
            "exp" => 0,
            "next_exp" => SkillExpDictionary::getNeedExp(1)
        ]);

        return $skillInfo;
    }
}