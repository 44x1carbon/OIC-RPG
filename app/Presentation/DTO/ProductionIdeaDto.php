<?php

namespace App\Presentation\DTO;

class ProductionIdeaDto
{
    public $productionTheme;
    public $productionTypeDto;
    public $ideaDescription;

    function __construct(string $productionTheme = null, ProductionTypeDto $productionTypeDto = null, string $ideaDescription = null)
    {
        $this->productionTheme = $productionTheme;
        $this->productionTypeDto = $productionTypeDto;
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
     * @param string $productionTheme
     */
    public function setProductionTheme(string $productionTheme)
    {
        $this->productionTheme = $productionTheme;
    }

    /**
     * @return ProductionTypeDto
     */
    public function productionTypeDto(): ProductionTypeDto
    {
        return $this->productionTypeDto;
    }

    /**
     * @param ProductionTypeDto $productionTypeDto
     */
    public function setProductionTypeDto(ProductionTypeDto $productionTypeDto)
    {
        $this->productionTypeDto = $productionTypeDto;
    }

    /**
     * @return string
     */
    public function ideaDescription(): string
    {
        return $this->ideaDescription;
    }

    /**
     * @param string $ideaDescription
     */
    public function setIdeaDescription(string $ideaDescription)
    {
        $this->ideaDescription = $ideaDescription;
    }
}