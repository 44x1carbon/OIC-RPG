<?php

namespace App\Domain\Status\Entity;

use App\Domain\EntityInterface;
use App\Domain\EntityTrait;
use App\Domain\Status\ValueObject\CourseInfo;
use App\Domain\Status\ValueObject\SkillInfo;

class Course implements EntityInterface
{
    use EntityTrait;

    const SCOPE_INFO = "info";
    const SCOPE_GETTABLE_SKILLS = "gettableSkills";
    const SCOPE_GETTABLE_JOBS = "gettableJobs";

    function info():CourseInfo
    {
        return $this->getScope(self::SCOPE_INFO);
    }

    /**
     * @return SkillInfo[]
     */
    function gettableSkills():array
    {
        return $this->getScope(self::SCOPE_GETTABLE_SKILLS);
    }

    /**
     * @return JobInfo[]
     */
    function gettableJobs():array
    {
        return $this->getScope(self::SCOPE_GETTABLE_JOBS);
    }
}