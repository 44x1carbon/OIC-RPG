<?php

namespace App\Presentation\DTO;

class ProductionTypeDto
{
    public $id;
    public $name;

    function __construct(string $id = null, string $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}