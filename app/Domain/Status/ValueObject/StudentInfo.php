<?php

namespace App\Domain\Status\ValueObject;

use App\Domain\ValueObjectInterface;
use App\Domain\ValueObjectTrait;

class StudentInfo implements ValueObjectInterface
{
    use ValueObjectTrait;

    public $name;
    public $studentCode;
    public $belongClass;
}