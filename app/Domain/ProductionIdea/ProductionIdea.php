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

class ProductionIdea
{
    private $id;
    // 制作テーマ
    private $productionTheme;
//    private $productionTypeId;
    // 制作物の種類
    private $productionType;
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

    public function productionType(): ProductionType
    {
//        $productionTypeRepository = app(ProductionTypeRepositoryInterface::class);
//        return $productionTypeRepository->findById($this->productionTypeId);
        return $this->productionType;
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
     * @param mixed $productionType
     */
    public function setProductionType(ProductionType $productionType)
    {
        $this->productionType = $productionType;
    }

    public function setIdeaDescription(String $ideaDescription)
    {
        $this->ideaDescription = $ideaDescription;
    }
}