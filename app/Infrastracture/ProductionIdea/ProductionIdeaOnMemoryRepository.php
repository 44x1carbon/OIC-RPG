<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 16:48
 */

namespace App\Infrastracture\ProductionIdea;


use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\ProductionIdea\RepositoryInterface\ProductionIdeaRepositoryInterface;

class ProductionIdeaOnMemoryRepository implements ProductionIdeaRepositoryInterface
{
    private $data = [];

    public function findById(String $id): ?ProductionIdea
    {
        $result = array_filter($this->data, function(ProductionIdea $productionIdea) use($id){
            return $productionIdea->id() == $id;
        });

        $result = array_values($result);
        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(ProductionIdea $productionIdea): bool
    {
        $dataInFlg = false;
        foreach ($this->data as $key => $dataProductionIdea){
            if ($dataProductionIdea->id() === $productionIdea->id()){
                $this->data[$key] = $productionIdea;
                $dataInFlg = true;
            }
        }
        if (!$dataInFlg){
            $this->data[] = $productionIdea;
        }
        return true;
    }

    public function all(): Array
    {
        return $this->data;
    }
}