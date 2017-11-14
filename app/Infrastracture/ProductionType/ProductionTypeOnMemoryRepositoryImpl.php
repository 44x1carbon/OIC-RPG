<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 11:54
 */

namespace App\Infrastracture\ProductionType;


use App\Domain\ProductionType\ProductionType;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;

class ProductionTypeOnMemoryRepositoryImpl implements ProductionTypeRepositoryInterface
{
    private $data = [];

    /**
     * @param String $id
     * @return ProductionType|null
     */
    public function findByName(String $name): ?ProductionType
    {
        $result = array_filter($this->data, function(ProductionType $productionType) use($name){
            return $productionType->name() === $name;
        });

        $result = array_values($result);
        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    // オンメモリー時のみ存在
    public function save(ProductionType $productionType): bool
    {
        $this->data[] = $productionType;
        return true;
    }

    public function all(): array
    {
        return $this->data;
    }
}