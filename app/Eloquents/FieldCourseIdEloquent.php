<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;

class FieldCourseIdEloquent extends Model
{
    protected $table = 'course_field';

    protected $guarded = [];

    public function toVo(): string
    {
        return $this->course_id;
    }
}
