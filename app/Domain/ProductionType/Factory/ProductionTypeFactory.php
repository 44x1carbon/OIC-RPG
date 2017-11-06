<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/03
 * Time: 18:39
 */

namespace App\Domain\ProductionType\Factory;


use App\Domain\ProductionType\ProductionType;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\DomainUtility\RandomStringGenerator;

class ProductionTypeFactory
{
    private $repo;

    public function __construct()
    {
        $this->repo = app(ProductionTypeRepositoryInterface::class);
    }

    public function createProductionType(String $productionTypeName, String $id = null)
    {
        $productionType = new ProductionType();
        $productionType->setId($id? $id : $this->makeId());
        $productionType->setProductionTypeName($productionTypeName);
        return $productionType;
    }

    /**
     * 新規にEntityに割り振る一意のIDを作成する
     * @return string
     */
    public function makeId()
    {
        $randId = RandomStringGenerator::makeLowerCase(4);
        $reCreateIdFlg = true;
        do{
            if (is_null($this->repo->findById($randId))){
                // findByIdがnullの場合、DBにIDのかぶりがないので正しい
                $reCreateIdFlg = false;
            }else{
                $randId = RandomStringGenerator::makeLowerCase(4);
            }
        }while ($reCreateIdFlg);
        return $randId;
    }
}