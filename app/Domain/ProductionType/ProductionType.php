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

    public function __construct()
    {
    }

    public function id(): String
    {
        return $this->id;
    }

    public function  productionTypeName(): String
    {
        return $this->productionTypeName;
    }

    public function setId(String $id)
    {
        $this->id = $id;
    }

    public function setProductionTypeName(String $productionTypeName)
    {
        $this->productionTypeName = $productionTypeName;
    }
}