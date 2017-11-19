<?php

namespace App\Domain\ProductionType\Factory;

use App\Domain\ProductionType\ProductionType;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\DomainUtility\RandomStringGenerator;

class ProductionTypeFactory
{
    protected $productionTypeRepository;

    function __construct(ProductionTypeRepositoryInterface $productionTypeRepository)
    {
        $this->productionTypeRepository = $productionTypeRepository;
    }

    public function createProductionType(string $productionTypeName, string $productionTypeId = null):ProductionType
    {
        return new ProductionType($productionTypeId ?? $this->makeId(), $productionTypeName);
    }

    public function makeId(): string
    {
        do {
            $id = RandomStringGenerator::makeLowerCase(2);
        } while($this->productionTypeRepository->findById($id));

        return $id;
    }
}