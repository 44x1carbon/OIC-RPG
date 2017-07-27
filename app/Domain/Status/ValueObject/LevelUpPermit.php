<?php

namespace App\Domain\Status\ValueObject;

use App\Domain\ValueObjectInterface;
use App\Domain\ValueObjectTrait;

class LevelUpPermit implements ValueObjectInterface
{
    use ValueObjectTrait;

    public $studentSkill;
}