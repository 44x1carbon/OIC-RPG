<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/03
 * Time: 18:39
 */

namespace App\Domain\ProductionType\Factory;


use App\Domain\ProductionType\ProductionType;

class ProductionTypeFactory
{

    public function __construct()
    {
    }

    public function createProductionType(String $productionTypeName)
    {
        $productionType = new ProductionType($productionTypeName);
        return $productionType;
    }

}