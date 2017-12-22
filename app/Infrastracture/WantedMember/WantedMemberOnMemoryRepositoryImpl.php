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

    public function findById(string $id): ?WantedMember
    {
        $result = array_filter($this->data, function(WantedMember $wantedMember) use($id){
            return $wantedMember->id() == $id;
        });

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(WantedMember $wantedMember): bool
    {
        $dataInFlg = false;
        foreach ($this->data as $key => $dataWantedMember){
            if ($dataWantedMember->id() === $wantedMember->id()){
                $this->data[$key] = $wantedMember;
                $dataInFlg = true;
            }
        }
        if (!$dataInFlg){
            $this->data[] = $wantedMember;
        }
        return true;
    }

    public function all(): array
    {
        return $this->data;
    }
}