<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/24
 * Time: 19:21
 */

namespace App\Domain\ProductionType;


class ProductionType
{
    private $id;
    private $productionTypeName;

    public function __construct(String $id,String $productionTypeName)
    {
        $this->id = $id;
        $this->productionTypeName = $productionTypeName;
    }

    public function Id(): String
    {
        return $this->id;
    }

    public function  ProductionTypeName(): String
    {
        return $this->productionTypeName;
    }

}