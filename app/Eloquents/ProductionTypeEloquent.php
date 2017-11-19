<?php

namespace App\Eloquents;

use App\Domain\ProductionType\Factory\ProductionTypeFactory;
use App\Domain\ProductionType\ProductionType;
use Illuminate\Database\Eloquent\Model;

class ProductionTypeEloquent extends Model
{
    protected $table = 'production_types';

    /* @var ProductionTypeFactory $factory */
    protected $factory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->factory = app(ProductionTypeFactory::class);
    }

    public function toEntity(): ProductionType
    {
        return $this->factory->createProductionType($this->production_type_id, $this->production_type_name);
    }

    public function findById(string $id): ?ProductionTypeEloquent
    {
        return $this->where('product_type_id', $id)->first();
    }
}
