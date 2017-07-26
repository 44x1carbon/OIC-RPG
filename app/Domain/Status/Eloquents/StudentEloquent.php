<?php

namespace App\Domain\Status\Eloquents;

use App\Domain\Status\Entity\Student;
use App\Domain\Status\ValueObject\StudentInfo;
use Illuminate\Database\Eloquent\Model;

class StudentEloquent extends Model
{
    protected $table = "students";
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(CourseEloquent::class, "belong_course_id");
    }

    public function skills()
    {
        return $this->hasMany(StudentSkillEloquent::class, "student_id");
    }

    public function jobs()
    {
        return $this->belongsToMany(JobEloquent::class, "student_jobs", "student_id", "job_id");
    }

    public function toValueObject():StudentInfo
    {
        return new StudentInfo([
            "name" => $this->name,
            "studentCode" => $this->student_code,
            "belongClass" => $this->belong_class
        ]);
    }

    public function toEntity():Student
    {
        $scope = [
            Student::SCOPE_INFO => $this->toValueObject()
        ];

        return new Student($this->id, $scope);
    }

    public function fromEntity(Student $student):StudentEloquent
    {
        return static::find($student->getId());
    }
}
