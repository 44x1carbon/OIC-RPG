<?php

namespace App\Domain\Status\Repository;

use App\Domain\Status\Eloquents\CourseEloquent;
use App\Domain\Status\Eloquents\SkillEloquent;
use App\Domain\Status\Entity\Course;
use App\Domain\Status\Entity\Skill;
use App\Domain\Status\ValueObject\CourseInfo;

class CourseRepository
{
    protected $courseModel;
    protected $skillModel;

    function __construct(
        CourseEloquent  $courseModel,
        SkillEloquent   $skillModel )
    {
        $this->courseModel  =   $courseModel;
        $this->skillModel   =   $skillModel;
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
}