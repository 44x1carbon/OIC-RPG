<?php

namespace App\Domain\PartyWrittenRequest\ValueObject;

use App\Domain\ProductionType\ProductionType;

class ProductionIdeaInfo
{
    // 制作テーマ
    private $productionTheme;
    // 制作物の種類
    private $productionType;
    // アイデア説明
    private $ideaDescription;

    function __construct(string $productionTheme, ProductionType $productionType, string $ideaDescription)
    {
        $this->productionTheme = $productionTheme;
        $this->productionType = $productionType;
        $this->ideaDescription = $ideaDescription;
    }

    /**
     * @return string
     */
    public function productionTheme(): string
    {
        return $this->productionTheme;
    }

    /**
     * @return ProductionType
     */
    public function productionType(): ProductionType
    {
        return $this->productionType;
    }

    /**
     * @return string
     */
    public function ideaDescription(): string
    {
        return $this->ideaDescription;
    }
}