<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 15:49
 */

namespace App\Domain\Party;


use App\Domain\GuildMember\GuildMember;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\ProductionIdea\ProductionIdea;

class Party
{
    private $id;
    // 活動終了日付
    private $activityEndDate;
    // 制作物アイデア
    private $productionIdea;
    // パーティ管理者
    private $partyManager;
    // パーティメンバー
    private $partyMembers;
    // メンバー募集
    private $wanteds;

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

    public function getPartyManager(): GuildMember
    {
        return $this->partyManager;
    }

    public function getPartyMembers(): array
    {
        return $this->partyMembers;
    }

    public function wanteds(): array
    {
        return $this->wanteds;
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

    public function setPartyManager(GuildMember $partyManager)
    {
        $this->partyManager = $partyManager;
    }

    public function setPartyMembers(array $partyMembers)
    {
        $this->partyMembers = $partyMembers;
    }

    public function setWanteds(array $wanteds)
    {
        $this->wanteds = $wanteds;
    }


}