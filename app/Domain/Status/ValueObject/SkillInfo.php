<?php

namespace App\Domain\Status\ValueObject;

use App\Domain\ValueObjectInterface;
use App\Domain\ValueObjectTrait;

class SkillInfo implements ValueObjectInterface
{
    use ValueObjectTrait;

    public $skillCode;
    public $name;
    public $memo;
}