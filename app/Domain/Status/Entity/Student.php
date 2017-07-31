<?php

namespace App\Domain\Status\Entity;

use App\Domain\EntityInterface;
use App\Domain\EntityTrait;
use App\Domain\Status\ValueObject\CourseInfo;
use App\Domain\Status\ValueObject\RequiredSkillInfo;
use App\Domain\Status\ValueObject\StudentInfo;
use App\Domain\Status\ValueObject\StudentSkillInfo;

class Student implements EntityInterface
{
    use EntityTrait;

    const SCOPE_INFO = "info";
    const SCOPE_STUDENT_SKILLS = "student_skills";
    const SCOPE_STUDENT_JOBS = "student_jobs";
    const SCOPE_COURSE_INFO = "course_info";

    function info():StudentInfo
    {
        return $this->getScope(self::SCOPE_INFO);
    }

    function studentSkills():array
    {
        return $this->getScope(self::SCOPE_STUDENT_SKILLS);
    }

    function studentJobs():array
    {
        return $this->getScope(self::SCOPE_STUDENT_JOBS);
    }

    function courseInfo():CourseInfo
    {
        return $this->getScope(self::SCOPE_COURSE_INFO);
    }

    function isGettableJob(Job $job): bool
    {
        $studentSkills = $this->studentSkills();
        $requiredSkills = $job->requiredSkills();

        $studentSkillsHash = array_column($studentSkills, null, "skillCode");

        $filtered = array_filter($requiredSkills, function(RequiredSkillInfo $requiredSkillInfo) use($studentSkillsHash) {
            $key = $requiredSkillInfo->skillCode;
            if(!array_key_exists($key, $studentSkillsHash)) return false;
            return $studentSkillsHash[$key]->level >= $requiredSkillInfo->requiredLevel;
        });

        return count($filtered) == count($requiredSkills);
    }
}