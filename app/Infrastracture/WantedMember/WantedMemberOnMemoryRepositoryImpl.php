<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:05
 */

namespace App\Infrastracture\WantedMember;


use App\Domain\WantedMember\WantedMember;
use App\Domain\WantedMember\RepositoryInterface\WantedMemberRepositoryInterface;

class WantedMemberOnMemoryRepositoryImpl implements WantedMemberRepositoryInterface
{
    private $data = [];

    public function findById(String $id): ?WantedMember
    {
        $result = array_filter($this->data, function(WantedMember $Wantedmember) use($id){
            return $Wantedmember->id() == $id;
        });

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(WantedMember $Wantedmember): bool
    {
        $dataInFlg = false;
        foreach ($this->data as $key => $dataWantedMember){
            if ($dataWantedMember->id() === $Wantedmember->id()){
                $this->data[$key] = $Wantedmember;
                $dataInFlg = true;
            }
        }
        if (!$dataInFlg){
            $this->data[] = $Wantedmember;
        }
        return true;
    }

    public function all(): Array
    {
        return $this->data;
    }
}