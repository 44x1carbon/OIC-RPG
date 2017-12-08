<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $primaryKey = "job_id";

    public function getCondition()
    {
        return $this->hasMany('App\GetCondition');
    }
}
