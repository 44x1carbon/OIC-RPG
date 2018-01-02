<?php

namespace App\Domain\MemberSkillStatus;

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
}