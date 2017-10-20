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
use PhpParser\Node\Expr\Array_;

class CourseOnMemoryRepositoryImpl implements CourseRepositoryInterface
{
    private $data = [];

    public function findById(String $id): Course
    {
        return array_filter($this->data, function(Course $course) use($id){
            return $course->Id() === $id;
        })[0];
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