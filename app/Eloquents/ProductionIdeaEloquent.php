<?php

namespace App\Eloquents;

use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionIdea\ValueObject\ProductionIdeaId;
use App\Domain\ProductionType\ValueObject\ProductionTypeId;
use Illuminate\Database\Eloquent\Model;

class ProductionIdeaEloquent extends Model
{
    protected $table = 'production_ideas';

    public function partyEloquent()
    {
        return $this->belongsTo(PartyEloquent::class, 'party_id');
    }

    public static function saveDomainObject(ProductionIdea $productionIdea, PartyEloquent $parentModel)
    {
        $model = $parentModel->productionIdeaEloquent;
        if(is_null($model)) $model = new static();
        $model->setAttrByEntity($productionIdea);
        $model->partyEloquent()->associate($parentModel);

        return $model->save();
    }

    public function setAttrByEntity(ProductionIdea $productionIdea): ProductionIdeaEloquent
    {
        $this->production_idea_id = $productionIdea->id();
        $this->production_theme = $productionIdea->productionTheme();
        $this->production_type_id = $productionIdea->productionTypeId();
        $this->idea_description = $productionIdea->ideaDescription();
        return $this;
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
        return new ProductionIdea(
            $this->production_idea_id,
            $this->production_theme,
            $this->production_type_id,
            $this->idea_description
        );
    }
}
