<?php

namespace App\Infrastracture\ProductionType;

use App\Domain\ProductionType\ProductionType;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Domain\ProductionType\ValueObject\ProductionTypeId;
use App\Eloquents\ProductionTypeEloquent;

class ProductionTypeEloquentRepositoryImpl implements ProductionTypeRepositoryInterface
{
    protected $eloquent;

    function __construct(ProductionTypeEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function findById(ProductionTypeId $id): ?ProductionType
    {
        return null_safety($this->eloquent->findById($id), function(ProductionTypeEloquent $value) {
            return $value->toEntity();
        });
    }

    public function save(ProductionType $productionType): bool
    {
        $model = $this->eloquent->findById($productionType->id());

        if(is_null($model)) {
            $model = new $this->eloquent();
            $model->production_type_id = $productionType->id()->code();
        }

        $model->name = $productionType->name();

        return $model->save();
    }

    public function all(): array
    {
        return $this->eloquent->all()->map(function(ProductionTypeEloquent $model) {
            return $model->toEntity();
        })->toArray();
    }

    public function findByName(String $name): ?ProductionType
    {
        return null_safety($this->eloquent->where('name', $name)->first(), function(ProductionTypeEloquent $model) {
            return $model->toEntity();
        });
    }
}