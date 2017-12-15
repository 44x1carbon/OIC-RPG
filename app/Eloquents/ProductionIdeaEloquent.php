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

    public static function fromEntity(ProductionIdea $productionIdea): ProductionIdeaEloquent
    {
        $model = self::where('production_idea_id', $productionIdea->id())->first();
        if(is_null($model)) {
            $model = new static();
            $model->production_idea_id = $productionIdea->id();
        }

        $model->production_theme = $productionIdea->productionTheme();
        $model->production_type_id = $productionIdea->productionTypeId();
        $model->idea_description = $productionIdea->ideaDescription();

        return $model;
    }

    public static function saveDomainObject(ProductionIdea $productionIdea, PartyEloquent $parentModel)
    {
        $model = self::fromEntity($productionIdea);
        $model->partyEloquent()->associate($parentModel);

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

        return new ProductionIdea(
            $this->production_idea_id,
            $this->production_theme,
            $this->production_type_id,
            $this->idea_description
        );
    }
}
