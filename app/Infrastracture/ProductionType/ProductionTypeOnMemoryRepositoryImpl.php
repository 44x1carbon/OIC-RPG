<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 11:54
 */

namespace App\Infrastracture\ProductionType;


use App\Domain\ProductionType\ProductionType;

class ProductionTypeOnMemoryRepositoryImpl
{
    private $data = [];

    /**
     * @param String $id
     * @return ProductionType|null
     */
    public function findById(String $id): ?ProductionType
    {
        $result = array_filter($this->data, function(ProductionType $productionType) use($id){
            return $productionType->Id() === $id;
        });

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(ProductionType $productionType): bool
    {
        $this->data[] = $productionType;
        return true;
    }

    public function all(): Array
    {
        return $this->data;
    }
}