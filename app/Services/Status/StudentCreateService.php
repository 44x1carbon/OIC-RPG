<?php

namespace App\Services\Status;

use App\Domain\Status\Entity\Course;
use App\Domain\Status\Entity\Student;
use App\Domain\Status\Repository\StudentRepository;
use App\Domain\Status\ValueObject\SkillInfo;
use App\Domain\Status\ValueObject\StudentInfo;

class StudentCreateService
{
    protected $repo;

    function __construct(StudentRepository $repo)
    {
        $this->repo = $repo;
    }

    function create(StudentInfo $studentInfo, Course $course):Student
    {
        return $this->repo->create($studentInfo, $course);
    }

    function addSkill(Student $student, SkillInfo $skillInfo):SkillInfo
    {
        return $this->repo->addSkill($student, $skillInfo);
    }
}