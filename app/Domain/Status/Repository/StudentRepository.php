<?php

namespace App\Domain\Status\Repository;

use App\Domain\Status\Eloquents\StudentEloquent;
use App\Domain\Status\Entity\Course;
use App\Domain\Status\Entity\Student;
use App\Domain\Status\ValueObject\StudentInfo;

class StudentRepository
{
    protected $studentModel;
    protected $courseModel;

    function __construct(StudentEloquent $studentModel)
    {
        $this->studentModel = $studentModel;
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
}