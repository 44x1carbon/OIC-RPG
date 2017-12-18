<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/10
 * Time: 12:29
 */

namespace App\Domain\WantedRole;


use App\Domain\Party\Exception\NotFoundAssignableFrameException;
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

    public function __construct($id, $roleName, $jobId, $remarks, $wantedMembers = [])
    {
        $this->id = $id;
        $this->roleName = $roleName;
        $this->referenceJobId = $jobId;
        $this->remarks = $remarks;
        $this->wantedMemberList = new WantedMemberList($wantedMembers);
    }

    public function id(): String
    {
        return $this->id;
    }

    public function roleName(): String
    {
        return $this->roleName;
    }

    public function referenceJobId(): ?String
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

    public function remarks(): ?String
    {
        return $this->remarks;
    }

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

    public function setWantedMemberList(WantedMemberList $wantedMemberList)
    {
        $this->wantedMemberList = $wantedMemberList;
    }

    public function getAssignableFrame(): WantedMember
    {
        $assignableList = $this->wantedMemberList()->assignableList();
        if(count($assignableList) === 0) throw new NotFoundAssignableFrameException();

        return $assignableList[0];
    }

    public function addFrame(int $num)
    {
       $this->wantedMemberList()->addFrame($num);
    }
}