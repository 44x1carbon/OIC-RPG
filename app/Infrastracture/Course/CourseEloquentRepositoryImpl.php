<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/27
 * Time: 15:16
 */

namespace App\Infrastracture\Course;


use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Eloquents\CourseEloquent;

class CourseEloquentRepositoryImpl implements CourseRepositoryInterface
{
    protected $eloquent;

    function __construct(CourseEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function findById(String $id): ?Course
    {
        $courseModel = $this->eloquent->find($id);
        if(!$courseModel instanceof CourseEloquent) return null;
        return $courseModel->toEntity();
    }

    public function save(Course $course): bool
    {
        /* @var CourseEloquent $courseModel */
        $courseModel = $this->findById($course->id());
        if(is_null($courseModel)) $courseModel = new $this->eloquent();

        $courseModel->course_id = $course->id();
        $courseModel->name = $course->courseName();
        return $courseModel->save();
    }

    public function all(): Array
    {
        $courseModels = $this->eloquent->all();

        $courseCollection =  $courseModels->map(function(CourseEloquent $eloquent) {
            return $eloquent->toEntity();
        });
        return $courseCollection->toArray();
    }
}