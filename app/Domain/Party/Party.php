<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/31
 * Time: 15:49
 */

namespace App\Domain\Party;


use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Exception\NotFoundAssignableFrameException;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use App\Domain\Party\ValueObjects\PartyMember;
use App\Domain\ProductionIdea\ProductionIdea;
use App\Domain\WantedMember\WantedMember;
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

    public function __construct(string $id, ActivityEndDate $activityEndDate, StudentNumber $managerId, ProductionIdea $productionIdea = null, $wantedRoles = [])
    {
        $this->id = $id;
        $this->activityEndDate = $activityEndDate;
        $this->partyManagerId = $managerId;
        $this->productionIdea = $productionIdea ??new ProductionIdea( $this->id);
        $this->wantedRoles = $wantedRoles;
    }

    public function editProductionIdea(string $productionTheme = null, string $productionTypeId = null, string $ideaDescription = null)
    {
        if(!is_null($productionTheme))  $this->productionIdea->setProductionTheme($productionTheme);
        if(!is_null($productionTypeId)) $this->productionIdea->setProductionTypeId($productionTypeId);
        if(!is_null($ideaDescription))  $this->productionIdea->setIdeaDescription($ideaDescription);
    }

    public function assignMember(string $wantedRoleId, StudentNumber $memberId)
    {
        $wantedRole = $this->findWantedRoleById($wantedRoleId);

        $wantedMember = $wantedRole->getAssignableFrame();
        $wantedMember->assign($memberId);
    }

    public function addWantedRole(string $roleName, string $jobId = null, string $remarks = null): string
    {
        $wantedRole = new WantedRole($this->nextWantedRoleId(), $roleName, $jobId, $remarks);
        $this->wantedRoles[] = $wantedRole;
        return $wantedRole->id();
    }

    public function addWantedFrame(string $wantedRoleId, int $num)
    {
        /* @var WantedRole $wantedRole */
        $wantedRole = $this->findWantedRoleById($wantedRoleId);
        $wantedRole->addFrame($num);
    }

    private function findWantedRoleById(string $wantedRoleId): ?WantedRole
    {
        $filterArr = array_values(array_filter($this->wantedRoles(), function(WantedRole $wantedRole) use($wantedRoleId){
            return $wantedRole->id() === $wantedRoleId;
        }));

        if(count($filterArr) === 0) return null;
        return $filterArr[0];
    }

    private function nextWantedRoleId(): string
    {
        return (string) (count($this->wantedRoles) + 1);
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
        $guildMemberRepo = app(GuildMemberRepositoryInterface::class);

        $members = array_flatten(array_map(function(WantedRole $wantedRole) use($guildMemberRepo){
            return array_map(function(WantedMember $wantedMember) use ($wantedRole, $guildMemberRepo){
                /* @var GuildMember $guildMember */
                $guildMember = $guildMemberRepo->findByStudentNumber($wantedMember->officerId());
                return new PartyMember(
                    $wantedRole->roleName(),
                    $wantedMember->officerId(),
                    $guildMember->studentName()
                );
            }, $wantedRole->wantedMemberList()->assignedList());
        }, $this->wantedRoles));
        return $members;
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