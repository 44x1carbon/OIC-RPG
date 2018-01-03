<?php

namespace App\Domain\GuildMember\ValueObjects;

use App\Domain\GuildMember\Spec\MemberSkillStatusSpec;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Exceptions\DomainException;

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
    protected $possessionSkill;

    /**
     * MemberSkillStatus constructor.
     * @param string $skillId
     * @param SkillAcquisitionStatus $status
     * @param PossessionSkill $possessionSkill
     * @throws DomainException
     */
    function __construct(string $skillId, SkillAcquisitionStatus $status, PossessionSkill $possessionSkill = null)
    {
        $this->status = $status;
        $this->skillId = $skillId;
        $this->possessionSkill = $possessionSkill;

        if(!MemberSkillStatusSpec::canInstantiated($this)) throw new DomainException('does not meet the specification');
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

    /**
     * @return PossessionSkill
     */
    public function possessionSkill(): ?PossessionSkill
    {
        return $this->possessionSkill;
    }
}