<?php

namespace App\Eloquents;

use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionIdea\ValueObject\ProductionIdeaId;
use App\Domain\ProductionType\ValueObject\ProductionTypeId;
use Illuminate\Database\Eloquent\Model;

class ProductionIdeaEloquent extends Model
{
    protected $table = 'production_ideas';

    public static function fromEntity(ProductionIdea $productionIdea): ProductionIdeaEloquent
    {
        $model = self::where('production_idea_id', $productionIdea->id()->code())->first();
        if(is_null($model)) {
            $model = new static();
            $model->production_idea_id = $productionIdea->id()->code();
        }

        $model->production_theme = $productionIdea->productionTheme();
        $model->production_type_id = $productionIdea->productionTypeId()->code();
        $model->idea_description = $productionIdea->ideaDescription();

        return $model;
    }

    public static function saveDomainObject(ProductionIdea $productionIdea, string $id)
    {
        $model = self::fromEntity($productionIdea);
        $model->party_id = $id;

        return $model->save();
    }

    public function productionTypeEloquent()
    {
        return $this->belongsTo(ProductionTypeEloquent::class, 'id', 'production_type_id');
    }

    public function findById(ProductionIdeaId $id): ?ProductionIdeaEloquent
    {
        return $this->where('production_idea_id', $id->code())->first();
    }

    public function toEntity(): ProductionIdea
    {
        $productionIdea = new ProductionIdea();
        $productionIdea->setId(new ProductionIdeaId($this->production_idea_id));
        $productionIdea->setProductionTheme($this->production_theme);
        $productionIdea->setIdeaDescription($this->idea_description);
        $productionIdea->setProductionTypeId(new ProductionTypeId($this->production_type_id));

        return $productionIdea;
    }
}
