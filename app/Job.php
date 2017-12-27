<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $primaryKey = "job_id";

    public function getConditions()
    {
        return $this->hasMany('App\GetCondition');
    }
}
