<?php

namespace App\Infrastracture\ProductionType;


use App\Domain\ProductionType\ProductionType;

class ProductionTypeViewModel
{
    private $productionType;

    /**
     * ProductionTypeViewModel constructor.
     * @param \App\Domain\ProductionType\ProductionType|null $productionType
     */
    public function __construct(ProductionType $productionType)
    {
        $this->productionType = $productionType;
        $this->id = $productionType->id();
        $this->name = $productionType->name();
    }
}
