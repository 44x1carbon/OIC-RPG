<?php

namespace App\Domain\GuildMember\ValueObjects;

/**
 * GuildMemberのスキル取得状態を表現するドメインモデル
 * Class MemberSkillStatus
 * @package App\Domain\MemberSkillStatus
 */
class MemberSkillStatus
{
    /* @var SkillAcquisitionStatus $status */
    protected $status;
    protected $skillId;

    /**
     * MemberSkillStatus constructor.
     * @param string $skillId
     * @param SkillAcquisitionStatus $status
     */
    function __construct(string $skillId, SkillAcquisitionStatus $status)
    {
        $this->status = $status;
        $this->skillId = $skillId;
    }

    /**
     * @return SkillAcquisitionStatus
     */
    public function status(): SkillAcquisitionStatus
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function skillId(): string
    {
        return $this->skillId;
    }
}