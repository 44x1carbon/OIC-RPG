<?php

namespace App\Domain\Status\ValueObject;

use App\Domain\ValueObjectInterface;
use App\Domain\ValueObjectTrait;

class JobInfo implements ValueObjectInterface
{
    use ValueObjectTrait;

    public $jobCode;
    public $name;
    public $imageUrl;
    public $memo;
}