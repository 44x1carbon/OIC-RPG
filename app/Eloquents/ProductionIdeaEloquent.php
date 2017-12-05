<?php

namespace App\Eloquents;

use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionIdea\ValueObject\ProductionIdeaId;
use App\Domain\ProductionType\ValueObject\ProductionTypeId;
use Illuminate\Database\Eloquent\Model;

class ProductionIdeaEloquent extends Model
{
    protected $table = 'production_ideas';

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
