<?php

namespace App\Domain\Status\Entity;

use App\Domain\EntityInterface;
use App\Domain\EntityTrait;
use App\Domain\Status\ValueObject\CourseInfo;
use App\Domain\Status\ValueObject\StudentInfo;

class Student implements EntityInterface
{
    use EntityTrait;

    const SCOPE_INFO = "info";

    function info():StudentInfo
    {
        $this->getScope(self::SCOPE_INFO);
    }
}