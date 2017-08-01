<?php

namespace App\Domain\Status\Repository;

use App\Domain\Status\Eloquents\CourseEloquent;
use App\Domain\Status\Eloquents\JobEloquent;
use App\Domain\Status\Eloquents\SkillEloquent;
use App\Domain\Status\Entity\Course;
use App\Domain\Status\Entity\Job;
use App\Domain\Status\Entity\Skill;
use App\Domain\Status\ValueObject\CourseInfo;

class CourseRepository
{
    protected $courseModel;
    protected $skillModel;
    protected $jobModel;

    function __construct(
        CourseEloquent  $courseModel,
        SkillEloquent   $skillModel,
        JobEloquent     $jobModel
    )
    {
        $this->courseModel  = $courseModel;
        $this->skillModel   = $skillModel;
        $this->jobModel     = $jobModel;
    }

    function create(CourseInfo $info):Course
    {
        $data = [
            "name" => $info->name,
            "course_code" => $info->courseCode
        ];
        $model = $this->courseModel->create($data);

        return $model->toEntity();
    }

    function addGettableSkill(Course $course, Skill $skill):Skill
    {
        $courseModel = $this->courseModel->fromEntity($course);
        $skillModel = $this->skillModel->fromEntity($skill);

        $courseModel->gettableSkills()->save($skillModel);

        return $skillModel->toEntity();
    }

    function addGettableJob(Course $course, Job $job):Job
    {
        $courseModel = $this->courseModel->fromEntity($course);
        $jobModel = $this->jobModel->fromEntity($job);

        $courseModel->gettableJobs()->save($jobModel);

        return $jobModel->toEntity();
    }
}