<?php

namespace App\Infrastracture\Field;


use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\Field\Field;
use App\Domain\Job\Job;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\Job\ValueObjects\JobId;
use App\Infrastracture\Course\CourseViewModel;
use App\Infrastracture\Job\JobViewModel;

class FieldViewModel
{
    private $field;
    /* @var CourseRepositoryInterface $courseRepo */
    private $courseRepo;
    /* @var JobRepositoryInterface $jobRepo */
    private $jobRepo;
    private $courses = null;
    private $jobs = null;

    /**
     * FieldViewModel constructor.
     * @param $field
     */
    public function __construct(Field $field)
    {
        $this->field = $field;
        $this->name = $field->name();

        $this->courseRepo = app(CourseRepositoryInterface::class);
        $this->jobRepo = app(JobRepositoryInterface::class);
    }

    /**
     * @return array
     */
    public function courses(): array
    {
        if(is_null($this->courses)) {
            $courses = array_map(function($courseId) {
                return $this->courseRepo->findById($courseId);
            }, $this->field->courseIdList());
            $this->courses = array_map(function(Course $course) {
                return new CourseViewModel($course);
            }, $courses);
        }

        return $this->courses;
    }

    /**
     * @return array
     */
    public function jobs(): array
    {
        if(is_null($this->jobs)) {
            $jobs = array_map(function(JobId $jobId) {
                return $this->jobRepo->findById($jobId->code());
            }, $this->field->jobIdList());
            $this->jobs = array_map(function(Job $job) {
                return new JobViewModel($job);
            }, $jobs);
        }

        return $this->jobs;
    }
}
