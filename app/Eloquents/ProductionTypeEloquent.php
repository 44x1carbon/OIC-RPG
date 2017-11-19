<?php

namespace App\Eloquents;

use App\Domain\ProductionType\Factory\ProductionTypeFactory;
use App\Domain\ProductionType\ProductionType;
use Illuminate\Database\Eloquent\Model;

class ProductionTypeEloquent extends Model
{
    protected $table = 'production_types';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function toEntity(): ProductionType
    {
        return new ProductionType($this->production_type_id, $this->production_type_name);
    }

    public function findById(string $id): ?ProductionTypeEloquent
    {
        return $this->where('product_type_id', $id)->first();
    }
}
