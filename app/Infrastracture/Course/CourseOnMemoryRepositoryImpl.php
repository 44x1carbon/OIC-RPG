<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/20
 * Time: 14:50
 */

namespace App\Infrastracture\Course;


use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;

class CourseOnMemoryRepositoryImpl implements CourseRepositoryInterface
{
    private $data = [];

    public function findById(String $id): ?Course
    {
        $result = array_filter($this->data, function(Course $course) use($id){
            return $course->id() === $id;
        });
        $result = array_values($result);

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(Course $course): bool
    {
        $this->data[] = $course;
        return true;
    }

    public function all(): Array
    {
        return $this->data;
    }
}