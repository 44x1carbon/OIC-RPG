<?php

namespace App\Eloquents;

use App\Domain\Course\Course;
use Illuminate\Database\Eloquent\Model;

class CourseEloquent extends Model
{
    //
    protected $table = 'courses';

    public function toEntity(): Course
    {
        return new Course($this->course_id, $this->name);
    }

    public function findById(String $id): ?CourseEloquent
    {
        return $this->where('course_id', $id)->first();
    }
}
