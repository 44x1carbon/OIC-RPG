<?php

namespace App\Services\Status;

use App\Domain\Status\Entity\Course;
use App\Domain\Status\Entity\Skill;
use App\Domain\Status\Repository\CourseRepository;
use App\Domain\Status\ValueObject\CourseInfo;

class CourseCreateService
{
    protected $repo;

    function __construct(CourseRepository $repo)
    {
        $this->repo = $repo;
    }

    function create(CourseInfo $info):Course
    {
        return $this->repo->create($info);
    }

    function addGettableSkill(Course $course, Skill $skill):Skill
    {
        return $this->repo->addGettableSkill($course, $skill);
    }
}