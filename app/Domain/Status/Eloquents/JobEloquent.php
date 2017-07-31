<?php

namespace App\Domain\Status\Eloquents;

use App\Domain\Status\Entity\Job;
use App\Domain\Status\ValueObject\JobInfo;
use Illuminate\Database\Eloquent\Model;

class JobEloquent extends Model
{
    protected $table = "jobs";
    protected $guarded = [];

    public function requiredSkills()
    {
        return $this->hasMany(RequiredSkillEloquent::class, "job_id");
    }

    public function getRequiredSkills():array
    {
        return $this->requiredSkills->map(function(RequiredSkillEloquent $r) {
            return $r->toValueObject();
        })->toArray();
    }

    function toEntity():Job
    {
        $scope = [
            Job::SCOPE_INFO => $this->toValueObject(),
            Job::SCOPE_REQUIRED_SKILLS => $this->getRequiredSkills()
        ];
        return new Job($this->id, $scope);
    }

    function toValueObject():JobInfo
    {
        return new JobInfo([
            "jobCode" => $this->job_code,
            "name" => $this->name,
            "imageUrl" => $this->image_url,
            "memo" => $this->memo
        ]);
    }

    static function fromEntity(Job $job):JobEloquent
    {
        return self::find($job->getId());
    }
}
