<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/08
 * Time: 19:21
 */

namespace App\Domain\PartyWrittenRequest;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\PartyWrittenRequest\ValueObject\ProductionIdeaInfo;
use App\Domain\PartyWrittenRequest\ValueObject\WantedRoleInfo;

class PartyWrittenRequest
{
    private $id;
    // パーティ作成申請者
    private $applicantId;
    // 活動終了日付
    private $activityEndDate;
    // 制作アイデア
    private $productionIdeaInfo;
    // 募集役割のリスト
    private $wantedRoleInfoList;

    public function __construct()
    {
    }

    public function id(): String
    {
        return $this->id;
    }

    public function applicantId(): StudentNumber
    {
        return $this->applicantId;
    }

    public function activityEndDate(): ActivityEndDate
    {
        return $this->activityEndDate;
    }

    /**
     * @return ProductionIdeaInfo
     */
    public function productionIdeaInfo(): ProductionIdeaInfo
    {
        return $this->productionIdeaInfo;
    }

    /**
     * @return WantedRoleInfo[]
     */
    public function wantedRoleInfoList(): array
    {
        return $this->wantedRoleInfoList;
    }

    public function setId(String $id)
    {
        $this->id = $id;
    }

    public function setApplicantId(StudentNumber $applicantId)
    {
        $this->applicantId = $applicantId;
    }

    public function setActivityEndDate(ActivityEndDate $activityEndDate)
    {
        $this->activityEndDate = $activityEndDate;
    }

    /**
     * @param ProductionIdeaInfo $productionIdeaInfo
     */
    public function setProductionIdeaInfo(ProductionIdeaInfo $productionIdeaInfo)
    {
        $this->productionIdeaInfo = $productionIdeaInfo;
    }

    /**
     * @param WantedRoleInfo[] $wantedRoleInfoList
     */
    public function setWantedRoleInfoList(array $wantedRoleInfoList)
    {
        $this->wantedRoleInfoList = $wantedRoleInfoList;
    }
}