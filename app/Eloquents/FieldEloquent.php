<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;

class FieldEloquent extends Model
{
    protected $table = 'fields';

    public function fieldCourseIds()
    {
        return $this->hasMany(FieldCourseIdEloquent::class, 'field_id');
    }

    public function fieldJobIds()
    {
        return $this->hasMany(FieldJobIdEloquent::class, 'field_id');
    }
}
