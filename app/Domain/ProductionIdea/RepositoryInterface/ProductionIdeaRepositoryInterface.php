<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 16:44
 */

namespace App\Domain\ProductionIdea\RepositoryInterface;


use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionIdea\ValueObject\ProductionIdeaId;

interface ProductionIdeaRepositoryInterface
{
    public function findById(ProductionIdeaId $id): ?ProductionIdea;

    public function save(ProductionIdea $productionIdea): bool;

    public function all(): array;
}