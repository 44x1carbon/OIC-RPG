<?php

namespace App\Domain\Utilities;

class Attr
{
    public $attrName;
    public $typeString;

    function __construct(string $attrName, string $typeString)
    {
        $this->attrName = $attrName;
        $this->typeString = $typeString;
    }
}