<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 16:45
 */

namespace App\Domain\ProductionIdea;


use App\Domain\ProductionType\ProductionType;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Domain\ProductionType\ValueObject\ProductionTypeId;

class ProductionIdea
{
    private $id;
    // 制作テーマ
    private $productionTheme;
    // 制作物の種類
    private $productionTypeId;
    // アイデア説明
    private $ideaDescription;

    public function id(): String
    {
        return $this->id;
    }

    public function productionTheme(): String
    {
        return $this->productionTheme;
    }

//    public function productionTypeId(): String
//    {
//        return $this->productionTypeId;
//    }

    public function productionTypeId(): ProductionTypeId
    {
        return $this->productionTypeId;
    }

    public function ideaDescription(): String
    {
        return $this->ideaDescription;
    }


    public function setId(String $id)
    {
        $this->id = $id;
    }

    public function setProductionTheme(String $productionTheme)
    {
        $this->productionTheme = $productionTheme;
    }

//    public function setProductionTypeId(String $productionTypeId)
//    {
//        $this->productionTypeId = $productionTypeId;
//    }

    /**
     * @param mixed $productionTypeId
     */
    public function setProductionTypeId(ProductionTypeId $productionTypeId)
    {
        $this->productionTypeId = $productionTypeId;
    }

    public function setIdeaDescription(String $ideaDescription)
    {
        $this->ideaDescription = $ideaDescription;
    }
}