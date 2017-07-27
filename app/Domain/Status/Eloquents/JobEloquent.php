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
        $this->belongsToMany(SkillEloquent::class, "required_skills", "job_id", "skill_id")->withPivot("required_level");
    }

    function toEntity():Job
    {
        $scope = [
            Job::SCOPE_INFO => $this->toValueObject()
        ];
        return new Job($this->id, $scope);
    }

    function toValueObject(): JobInfo
    {
        return new JobInfo([
            "jobCode" => $this->job_code,
            "name" => $this->name,
            "imageUrl" => $this->image_url,
            "memo" => $this->memo
        ]);
    }

}
