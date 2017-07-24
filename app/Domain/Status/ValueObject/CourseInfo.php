<?php

namespace App\Domain\Status\ValueObject;

use App\Domain\ValueObjectInterface;
use App\Domain\ValueObjectTrait;

class CourseInfo implements ValueObjectInterface
{
    use ValueObjectTrait;

    public $name;
    public $courseCode;
}