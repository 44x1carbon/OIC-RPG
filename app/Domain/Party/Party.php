<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 15:49
 */

namespace App\Domain\Party;


use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\WantedRole\WantedRole;

class Party
{
    private $id;
    // 活動終了日付
    private $activityEndDate;
    // 制作物アイデア
    private $productionIdea;
    // パーティ管理者ID
    private $partyManagerId;
    // パーティメンバーID一覧
    private $partyMembers;
    // 募集役割一覧
    private $wantedRoles;

    public function __construct()
    {
    }

    public function id(): String
    {
        return $this->id;
    }

    public function activityEndDate(): ActivityEndDate
    {
        return $this->activityEndDate;
    }


    public function productionIdea(): ProductionIdea
    {
        return $this->productionIdea;
    }

    public function partyManagerId(): StudentNumber
    {
        return $this->partyManagerId;
    }

    public function partyMembers(): array
    {
        return $this->partyMembers;
    }

    /**
     * @return WantedRole[]
     */
    public function wantedRoles(): array
    {
        return $this->wantedRoles;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setActivityEndDate(ActivityEndDate $activityEndDate)
    {
        $this->activityEndDate = $activityEndDate;
    }

    public function setProductionIdea(ProductionIdea $productionIdea)
    {
        $this->productionIdea = $productionIdea;
    }

    public function setPartyManagerId(StudentNumber $partyManagerId)
    {
        $this->partyManagerId = $partyManagerId;
    }

    public function setPartyMembers(array $partyMembers)
    {
        $this->partyMembers = $partyMembers;
    }

    public function setWantedRoles(array $wantedRoles)
    {
        $this->wantedRoles = $wantedRoles;
    }
}