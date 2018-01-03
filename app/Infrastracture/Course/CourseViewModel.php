<?php

namespace App\Infrastracture\Course;


use App\Domain\Course\Course;

class CourseViewModel
{
    private $course;

    /**
     * CourseViewModel constructor.
     * @param \App\Domain\Course\Course $course
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
        $this->id = $course->id();
        $this->name = $course->courseName();
    }
}
