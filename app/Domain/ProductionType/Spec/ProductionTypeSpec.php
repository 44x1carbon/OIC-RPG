<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/24
 * Time: 19:24
 */

namespace App\Domain\ProductionType\Spec;


use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\DomainUtility\SpecTrait;

class ProductionTypeSpec
{
    use SpecTrait;

    public static function isExistName(String $name): bool
    {
        /* @var ProductionTypeRepositoryInterface $repo */
        $repo = app(ProductionTypeRepositoryInterface::class);
        $productionType = $repo->findByName($name);
        return $productionType !== null;
    }
}