<?php

namespace App\Infrastracture\ProductionType;

use App\Domain\ProductionType\ProductionType;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;

class ProductionTypeEloquentRepositoryImpl implements ProductionTypeRepositoryInterface
{

    public function findById(String $id): ?ProductionType
    {
        // TODO: Implement findById() method.
    }

    public function save(ProductionType $productionType): bool
    {
        // TODO: Implement save() method.
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }
}