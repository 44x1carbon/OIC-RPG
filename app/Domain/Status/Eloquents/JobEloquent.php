<?php

namespace App\Domain\Status\Eloquents;

use Illuminate\Database\Eloquent\Model;

class JobEloquent extends Model
{
    protected $table = "jobs";

    public function requiredSkills()
    {
        $this->belongsToMany(SkillEloquent::class, "required_skills", "job_id", "skill_id")->withPivot("required_level");
    }
}
