<?php

namespace App\Domain\Status\Repository;

use App\Domain\Status\Eloquents\JobEloquent;
use App\Domain\Status\Eloquents\StudentEloquent;
use App\Domain\Status\Eloquents\StudentSkillEloquent;
use App\Domain\Status\Entity\Course;
use App\Domain\Status\Entity\Job;
use App\Domain\Status\Entity\Student;
use App\Domain\Status\Entity\StudentSkill;
use App\Domain\Status\ValueObject\SkillInfo;
use App\Domain\Status\ValueObject\StudentInfo;
use App\Domain\Status\ValueObject\StudentSkillInfo;
use App\Utilities\SkillExpDictionary;

class StudentRepository
{
    protected $studentModel;
    protected $studentSkillRepo;
    protected $skillRepo;
    protected $jobModel;

    function __construct(
        StudentEloquent $studentModel,
        SkillRepository $skillRepo,
        StudentSkillRepository $studentSkillRepo,
        JobEloquent $jobModel)
    {
        $this->studentModel = $studentModel;
        $this->skillRepo = $skillRepo;
        $this->studentSkillRepo = $studentSkillRepo;
        $this->jobModel = $jobModel;
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
        $skillModel = $this->skillRepo->findCode($skillInfo->skillCode);
        $studentSkillModel = $this->studentSkillRepo->makeForSkillModel($skillModel);
        $studentModel->skills()->save($studentSkillModel);

        return $skillInfo;
    }

    function findStudentSkill(Student $student, SkillInfo $skillInfo):StudentSkill
    {
        $studentModel = $this->studentModel->fromEntity($student);
        $skillModel = $this->skillRepo->findCode($skillInfo->skillCode);
        return $studentModel->skills()->first(["skill_id" => $skillModel->id])->toEntity();
    }

    function addJob(Student $student, Job $job):Job
    {
        $studentModel = $this->studentModel->fromEntity($student);
        $jobModel = $this->jobModel->fromEntity($job);
        $studentModel->jobs()->save($jobModel);

        return $jobModel->toEntity();
    }
}