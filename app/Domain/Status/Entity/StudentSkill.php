<?php

namespace App\Domain\Status\Entity;

use App\Domain\EntityInterface;
use App\Domain\EntityTrait;
use App\Domain\Status\ValueObject\CourseInfo;
use App\Domain\Status\ValueObject\StudentSkillInfo;
use App\Utilities\SkillExpDictionary;

class StudentSkill implements EntityInterface
{
    use EntityTrait;

    const SCOPE_INFO = "info";

    function info():StudentSkillInfo
    {
        return $this->getScope(self::SCOPE_INFO);
    }

    function isLevelUp():bool
    {
        $info = $this->info();
        $maxLevel = SkillExpDictionary::maxLevel();
        return $info->exp >= $info->nextExp && $info->level+1 <= $maxLevel;
    }
}