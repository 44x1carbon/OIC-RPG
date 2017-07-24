<?php

namespace App\Domain\Status\ValueObject;

use App\Domain\ValueObjectInterface;
use App\Domain\ValueObjectTrait;

class StudentSkill implements ValueObjectInterface
{
    use ValueObjectTrait;

    public $belongClass;
    public $belongCourse;
}