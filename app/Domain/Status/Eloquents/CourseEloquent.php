<?php

namespace App\Domain\Status\Eloquents;

use App\Domain\Status\Entity\Course;
use App\Domain\Status\ValueObject\CourseInfo;
use Illuminate\Database\Eloquent\Model;

class CourseEloquent extends Model
{
    protected $table = "courses";
    protected $guarded = [];

    public function gettableSkills()
    {
        $this->belongsToMany(SkillEloquent::class, "course_gettable_skills", "course_id", "skill_id");
    }

    public function gettableJobs()
    {
        $this->belongsToMany(JobEloquent::class, "course_gettable_jobs", "course_id", "job_id");
    }

    public function getInfo():CourseInfo
    {
        return new CourseInfo([
            "name" => $this->name,
            "courseCode" => $this->course_code
        ]);
    }

    public function toEntity():Course
    {
        $scope = [
            Course::SCOPE_INFO => $this->getInfo()
        ];

        return new Course($this->id, $scope);
    }
}
