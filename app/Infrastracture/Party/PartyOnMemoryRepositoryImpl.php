<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/07
 * Time: 16:00
 */

namespace App\Infrastracture\Party;


use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;

class PartyOnMemoryRepositoryImpl implements PartyRepositoryInterface
{
    private $data = [];

    public function findById(String $id): ?Party
    {
        $result = array_filter($this->data, function(Party $party) use($id){
            return $party->id() == $id;
        });

        $result = array_values($result);
        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(Party $party): bool
    {
        $dataInFlg = false;
        foreach ($this->data as $key => $dataParty){
            if ($dataParty->id() === $party->id()){
                $this->data[$key] = $party;
                $dataInFlg = true;
            }
        }
        if (!$dataInFlg){
            $this->data[] = $party;
        }
        return true;
    }

    public function all(): array
    {
        return $this->data;
    }

}