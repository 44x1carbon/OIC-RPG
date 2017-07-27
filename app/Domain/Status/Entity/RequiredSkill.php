<?php

namespace App\Domain\Status\Entity;

use App\Domain\EntityInterface;
use App\Domain\EntityTrait;
use App\Domain\Status\ValueObject\CourseInfo;
use App\Domain\Status\ValueObject\RequiredSkillInfo;

class RequiredSkill implements EntityInterface
{
    use EntityTrait;

    const SCOPE_INFO = "info";

    function info():RequiredSkillInfo
    {
        return $this->getScope(self::SCOPE_INFO);
    }
}