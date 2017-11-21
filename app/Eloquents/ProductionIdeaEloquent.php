<?php

namespace App\Eloquents;

use App\Domain\ProductionIdea\ValueObject\ProductionIdeaId;
use Illuminate\Database\Eloquent\Model;

class ProductionIdeaEloquent extends Model
{
    protected $table = 'production_ideas';

    public function findById(ProductionIdeaId $id): ?ProductionIdeaEloquent
    {
        return $this->where('production_idea_id', $id->code())->first();
    }
}
