<?php

namespace App\Infrastracture\ProductionType;

use App\Domain\ProductionType\ProductionType;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Eloquents\ProductionTypeEloquent;

class ProductionTypeEloquentRepositoryImpl implements ProductionTypeRepositoryInterface
{
    protected $eloquent;

    function __construct(ProductionTypeEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function findById(String $id): ?ProductionType
    {
        return safe_exec($this->eloquent->findById($id), function(ProductionTypeEloquent $value) {
            return $value->toEntity();
        });

    }

    public function save(ProductionType $productionType): bool
    {
        $model = $this->eloquent->findById($productionType->id());

        if(is_null($model)) {
            $model = new $this->eloquent();
            $model->production_type_id = $productionType->id();
        }

        $model->production_type_name = $productionType->productionTypeName();

        return $model->save();
    }

    public function all(): array
    {
        return $this->eloquent->all()->map(function(ProductionTypeEloquent $model) {
            return $model->toEntity();
        })->toArray();
    }
}