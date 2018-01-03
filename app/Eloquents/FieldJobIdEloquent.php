<?php

namespace App\Eloquents;

use App\Domain\Job\ValueObjects\JobId;
use Illuminate\Database\Eloquent\Model;

class FieldJobIdEloquent extends Model
{
    protected $table = 'field_job';

    protected $guarded = [];

    public function toVo(): JobId
    {
        return new JobId($this->job_id);
    }
}
