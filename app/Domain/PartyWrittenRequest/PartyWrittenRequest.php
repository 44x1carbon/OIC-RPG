<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/08
 * Time: 19:21
 */

namespace App\Domain\PartyWrittenRequest;


use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\WantedMember\ValueObjects\WantedRole;

class PartyWrittenRequest
{
    private $id;
    // パーティ作成申請者
    private $applicantId;
    // 活動終了日付
    private $activityEndDate;
    // 制作アイデア
    private $productionIdea;
    // 募集役割のリスト
    private $wantedRoleList;

    public function __construct()
    {
    }

    public function id()
    {
        return $this->id;
    }

    public function applicantId(): String
    {
        return $this->applicantId;
    }

    public function activityEndDate(): ActivityEndDate
    {
        return $this->activityEndDate;
    }

    public function productionIdea(): ProductionIdea
    {
        return $this->productionIdea;
    }

    /**
     * @return WantedRole[]
     */
    public function wantedRoleList(): array
    {
        return $this->wantedRoleList;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setApplicantId(String $applicantId)
    {
        $this->applicantId = $applicantId;
    }

    public function setActivityEndDate(ActivityEndDate $activityEndDate)
    {
        $this->activityEndDate = $activityEndDate;
    }

    public function setProductionIdea(ProductionIdea $productionIdea)
    {
        $this->productionIdea = $productionIdea;
    }

    public function setWantedRoleList(array $wantedRoleList)
    {
        $this->wantedRoleList = $wantedRoleList;
    }

}