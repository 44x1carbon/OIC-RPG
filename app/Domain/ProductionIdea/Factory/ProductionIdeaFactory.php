<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 14:56
 */

namespace App\Domain\ProductionIdea\Factory;


use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionType\ProductionType;

class ProductionIdeaFactory
{
    public function __construct()
    {

    }

    public function createProductionIdea(String $id, String $productionTheme, ProductionType $productionType, String $ideaDescription): ProductionIdea
    {
        $productionIdea = new ProductionIdea();
        $productionIdea->setId($id);
        $productionIdea->setProductionTheme($productionTheme);
        $productionIdea->setProductionType($productionType);
        $productionIdea->setIdeaDescription($ideaDescription);
        return $productionIdea;
    }
}