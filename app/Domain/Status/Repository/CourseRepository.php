<?php

namespace App\Domain\Status\Repository;

use App\Domain\Status\Eloquents\CourseEloquent;
use App\Domain\Status\Entity\Course;
use App\Domain\Status\ValueObject\CourseInfo;

class CourseRepository
{
    protected $courseModel;

    function __construct(CourseEloquent $courseModel)
    {
        $this->courseModel = $courseModel;
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
}