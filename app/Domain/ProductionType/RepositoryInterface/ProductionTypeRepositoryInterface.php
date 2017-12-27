<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/24
 * Time: 19:13
 */

namespace App\Domain\ProductionType\RepositoryInterface;


use App\Domain\ProductionType\ProductionType;

interface ProductionTypeRepositoryInterface
{
    public function findByName(String $name): ?ProductionType;

    public function findById(string $id): ?ProductionType;

    public function save(ProductionType $productionType): bool;

    public function all(): array;

    public function nextId(): string;
}