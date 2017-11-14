<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/10
 * Time: 12:29
 */

namespace App\Domain\WantedRole;


use App\Domain\WantedMember\WantedMember;
use App\Domain\WantedRole\ValueObject\WantedMemberList;

class WantedRole
{
    private $id;
    // 募集役割名
    private $name;
    // 参考ジョブID
    private $referenceJobId;
    // 参考スキルIDリスト
    private $referenceSkillIdList;
    // 備考
    private $remarks;
    // メンバー募集のリスト
    private $wantedMemberList;

    public function __construct()
    {
    }

    public function id(): String
    {
        return $this->id;
    }

    public function name(): String
    {
        return $this->name;
    }

    public function referenceJobId(): String
    {
        return $this->referenceJobId;
    }

    /**
     * @return String[]
     */
    public function referenceSkillIdList(): array
    {
        return $this->referenceSkillIdList;
    }

    public function remarks(): String
    {
        return $this->remarks;
    }

//    ToDo WantedMemberList VOに置き換え
    /**
     * @return WantedMemberList
     */
    public function wantedMemberList(): WantedMemberList
    {
        return $this->wantedMemberList;
    }

    public function setId(String $id)
    {
        $this->id = $id;
    }

    public function setName(String $name)
    {
        $this->name = $name;
    }

    public function setReferenceJobId(String $referenceJobId)
    {
        $this->referenceJobId = $referenceJobId;
        // TODO : ジョブを元に参考スキルを取得して参考スキルリストに格納する
    }

    public function setRemarks(String $remarks)
    {
        $this->remarks = $remarks;
    }

//    ToDo WantedMemberList VOに置き換え
    public function setWantedMemberList(WantedMemberList $wantedMemberList)
    {
        $this->wantedMemberList = $wantedMemberList;
    }
}