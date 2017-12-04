<?php

namespace App\Eloquents;

use App\Domain\ProductionType\Factory\ProductionTypeFactory;
use App\Domain\ProductionType\ProductionType;
use App\Domain\ProductionType\ValueObject\ProductionTypeId;
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
        return new ProductionType(new ProductionTypeId($this->production_type_id), $this->name);
    }

    public function findById(ProductionTypeId $id): ?ProductionTypeEloquent
    {
        return $this->where('product_type_id', $id->code())->first();
    }
}
