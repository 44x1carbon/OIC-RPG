<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/10
 * Time: 11:20
 */

namespace App\Infrastracture\PartyWrittenRequest;


use App\Domain\PartyWrittenRequest\PartyWrittenRequest;

class PartyWrittenRequestOnMemoryRepositoryImpl
{
    private $data = [];

    public function findById(String $id): ?PartyWrittenRequest
    {
        $result = array_filter($this->data, function(PartyWrittenRequest $partyWrittenRequest) use($id){
            return $partyWrittenRequest->id() == $id;
        });

        $result = array_values($result);
        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(PartyWrittenRequest $partyWrittenRequest): bool
    {
        $dataInFlg = false;
        foreach ($this->data as $key => $dataPartyWrittenRequest){
            if ($dataPartyWrittenRequest->id() === $partyWrittenRequest->id()){
                $this->data[$key] = $partyWrittenRequest;
                $dataInFlg = true;
            }
        }
        if (!$dataInFlg){
            $this->data[] = $partyWrittenRequest;
        }
        return true;
    }

    public function all(): array
    {
        return $this->data;
    }
}