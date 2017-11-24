<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 14:56
 */

namespace App\Domain\ProductionIdea\Factory;


use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionIdea\RepositoryInterface\ProductionIdeaRepositoryInterface;
use App\Domain\ProductionType\ProductionType;
use App\DomainUtility\RandomStringGenerator;

class ProductionIdeaFactory
{
    private $repo;

    public function __construct()
    {
        $this->repo = app(ProductionIdeaRepositoryInterface::class);
    }

    public function createProductionIdea(String $productionTheme, ProductionType $productionType, String $ideaDescription, String $id = null): ProductionIdea
    {
        $productionIdea = new ProductionIdea();
        $productionIdea->setId($id? $id : $this->makeId()); // 引数にIDが存在した場合は利用し、ない場合は新規にIDを作成する
        $productionIdea->setProductionTheme($productionTheme);
        $productionIdea->setProductionTypeId($productionType->id());
        $productionIdea->setIdeaDescription($ideaDescription);
        return $productionIdea;
    }

    /**
     * 新規にEntityに割り振る一意のIDを作成する
     * @return string
     */
    public function makeId()
    {
        $randId = RandomStringGenerator::makeLowerCase(4);
        $reCreateIdFlg = true;
        do {
            if (is_null($this->repo->findById($randId))){
                // findByIdがnullの場合、DBにIDのかぶりがないので正しい
                $reCreateIdFlg = false;
            }else{
                $randId = RandomStringGenerator::makeLowerCase(4);
            }
        } while ($reCreateIdFlg);
        return $randId;
    }
}