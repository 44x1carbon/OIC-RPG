<?php

namespace App\Infrastracture\ProductionIdea;

use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionIdea\RepositoryInterface\ProductionIdeaRepositoryInterface;

class ProductionIdeaEloquentRepositoryImpl implements ProductionIdeaRepositoryInterface
{

    public function findById(String $id): ?ProductionIdea
    {
        // TODO: Implement findById() method.
    }

    public function save(ProductionIdea $productionIdea): bool
    {
        // TODO: Implement save() method.
    }

    public function all(): array
    {
        // TODO: Implement all() method.
    }
}