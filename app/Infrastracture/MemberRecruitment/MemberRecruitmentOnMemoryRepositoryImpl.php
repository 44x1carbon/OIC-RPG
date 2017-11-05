<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:05
 */

namespace App\Infrastracture\MemberRecruitment;


use App\Domain\MemberRecruitment\MemberRecruitment;
use App\Domain\MemberRecruitment\RepositoryInterface\MemberRecruitmentRepositoryInterface;

class MemberRecruitmentOnMemoryRepositoryImpl implements MemberRecruitmentRepositoryInterface
{
    private $data = [];

    public function findById(String $id): ?MemberRecruitment
    {
        $result = array_filter($this->data, function(MemberRecruitment $memberRecruitment) use($id){
            return $memberRecruitment->id() == $id;
        });

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(MemberRecruitment $memberRecruitment): bool
    {
        $dataInFlg = false;
        foreach ($this->data as $key => $dataMemberRecruitment){
            if ($dataMemberRecruitment->id() === $memberRecruitment->id()){
                $this->data[$key] = $memberRecruitment;
                $dataInFlg = true;
            }
        }
        if (!$dataInFlg){
            $this->data[] = $memberRecruitment;
        }
        return true;
    }

    public function all(): Array
    {
        return $this->data;
    }
}