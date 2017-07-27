<?php

namespace App\Domain\Status\Entity;

use App\Domain\EntityInterface;
use App\Domain\EntityTrait;
use App\Domain\Status\ValueObject\CourseInfo;
use App\Domain\Status\ValueObject\JobInfo;

class Job implements EntityInterface
{
    use EntityTrait;

    const SCOPE_INFO = "info";
    const SCOPE_REQUIRED_SKILLS = "required_skills";

    function info(): JobInfo
    {
        return $this->getScope(self::SCOPE_INFO);
    }

    function requiredSkills(): array
    {
        return $this->getScope(self::SCOPE_REQUIRED_SKILLS);
    }
}