<?php

namespace App\Domain\Status\Eloquents;

use Illuminate\Database\Eloquent\Model;

class CourseEloquent extends Model
{
    protected $table = "courses";

    public function gettableSkills()
    {
        $this->belongsToMany(SkillEloquent::class, "course_gettable_skills", "course_id", "skill_id");
    }

    public function gettableJobs()
    {
        $this->belongsToMany(JobEloquent::class, "course_gettable_jobs", "course_id", "job_id");
    }
}
