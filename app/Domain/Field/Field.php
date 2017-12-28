<?php

namespace App\Domain\Field;

class Field
{
    private $name;
    private $jobIdList;
    private $courseIdList;

    public function __construct(string $name, array $jobIdList = [], array $courseIdList = [])
    {
        $this->name = $name;
        $this->jobIdList = $jobIdList;
        $this->courseIdList = $courseIdList;
    }

}