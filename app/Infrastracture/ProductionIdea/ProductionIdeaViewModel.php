<?php

namespace App\Infrastracture\ProductionIdea;

use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Infrastracture\ProductionType\ProductionTypeViewModel;

class ProductionIdeaViewModel
{
    /**
     * ProductionIdeaViewModel constructor.
     * @param ProductionIdea $productionIdea
     */
    function __construct(ProductionIdea $productionIdea)
    {
        /* @var ProductionTypeRepositoryInterface $productionTypeRepo */
        $productionTypeRepo = app(ProductionTypeRepositoryInterface::class);

        $this->productionTheme = $productionIdea->productionTheme();
        $productionType = $productionTypeRepo->findById($productionIdea->productionTypeId());
        $this->productionType = new ProductionTypeViewModel($productionType);
        $this->ideaDiscription = $productionIdea->ideaDescription();
    }
}