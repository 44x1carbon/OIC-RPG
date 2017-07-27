<?php

namespace App\Domain\Status\Entity;

use App\Domain\EntityInterface;
use App\Domain\EntityTrait;
use App\Domain\Status\ValueObject\CourseInfo;

class Course implements EntityInterface
{
    use EntityTrait;

    const SCOPE_INFO = "info";

    function info():CourseInfo
    {
        return $this->getScope(self::SCOPE_INFO);
    }
}