<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 16:45
 */

namespace App\Domain\ProductionIdea;


use App\Domain\ProductionIdea\ValueObject\ProductionIdeaId;
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


    function __construct($id, $productionTheme = null, $productionTypeId = null, $ideaDescription = null)
    {
        $this->id = $id;
        if($productionTypeId) $this->productionTypeId = $productionTypeId;
        $this->productionTheme = $productionTheme;
        $this->ideaDescription = $ideaDescription;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function productionTheme(): ?String
    {
        return $this->productionTheme;
    }


    public function productionTypeId(): ?string
    {
        return $this->productionTypeId;
    }

    public function ideaDescription(): ?String
    {
        return $this->ideaDescription;
    }


    public function setId(ProductionIdeaId $id)
    {
        $this->id = $id;
    }

    public function setProductionTheme(String $productionTheme)
    {
        $this->productionTheme = $productionTheme;
    }

    /**
     * @param mixed $productionTypeId
     */

    public function setProductionTypeId(string $productionTypeId)
    {
        $this->productionTypeId = $productionTypeId;
    }

    public function setIdeaDescription(String $ideaDescription)
    {
        $this->ideaDescription = $ideaDescription;
    }
}