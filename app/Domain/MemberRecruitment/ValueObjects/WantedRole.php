<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/07
 * Time: 12:20
 */

namespace App\Domain\MemberRecruitment\ValueObjects;

// 募集役割
class WantedRole
{
    // 募集役割名
    private $wantedRoleName;
    // 参考ジョブID
    private $referenceJobId;

    public function __construct(String $wantedRoleName, String $referenceJobId)
    {
        $this->wantedRoleName = $wantedRoleName;
        $this->referenceJobId = $referenceJobId;
    }

    public function wantedRoleName(): String
    {
        return $this->wantedRoleName;
    }

    public function referenceJobId(): String
    {
        return $this->referenceJobId;
    }

    public function setWantedRoleName(String $wantedRoleName)
    {
        $this->wantedRoleName = $wantedRoleName;
    }

    public function setReferenceJobId(String $referenceJobId)
    {
        $this->referenceJobId = $referenceJobId;
    }

}