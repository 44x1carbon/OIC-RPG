<?php

namespace App\Domain\ProductionIdea\ValueObject;

class ProductionIdeaId
{
    protected $code;

    function __construct(string $code)
    {
        $this->code = $code;
    }

    public function code(): string
    {
        return $this->code;
    }
}