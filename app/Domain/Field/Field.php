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

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function jobIdList(): array
    {
        return $this->jobIdList;
    }

    /**
     * @return array
     */
    public function courseIdList(): array
    {
        return $this->courseIdList;
    }

}