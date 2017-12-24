<?php

namespace App\Domain\ProductionType\ValueObject;

class ProductionTypeId
{
    protected $code;

    function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }
}