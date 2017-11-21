<?php

namespace App\Infrastracture\ProductionIdea;

use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionIdea\RepositoryInterface\ProductionIdeaRepositoryInterface;
use App\Domain\ProductionIdea\ValueObject\ProductionIdeaId;
use App\Eloquents\ProductionIdeaEloquent;

class ProductionIdeaEloquentRepositoryImpl implements ProductionIdeaRepositoryInterface
{
    protected $eloquent;

    function __construct(ProductionIdeaEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function findById(ProductionIdeaId $id): ?ProductionIdea
    {
        return null_safety($this->eloquent->findById($id), function(ProductionIdeaEloquent $model) {
            return $model->toEntity();
        });
    }

    public function save(ProductionIdea $productionIdea): bool
    {
        $model = $this->eloquent->findById($productionIdea->id());
        if(is_null($model)) {
            $model = new $this->eloquent();
            $model->production_idea_id = $productionIdea->id()->code();
        }

        $model->production_theme = $productionIdea->productionTheme();
        $model->production_type_id = $productionIdea->productionTypeId()->code();
        $model->idea_description = $productionIdea->ideaDescription();

        return $model->save();
    }

    public function all(): array
    {
        return $this->eloquent->all()->map(function(ProductionIdeaEloquent $eloquent) {
            return $eloquent->toEntity();
        })->toArray();
    }
}