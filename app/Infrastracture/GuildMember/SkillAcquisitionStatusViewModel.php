<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/01/03
 * Time: 1:00
 */

namespace App\Infrastracture\GuildMember;


use App\Domain\GuildMember\ValueObjects\SkillAcquisitionStatus;

/**
 * Class SkillAcquisitionStatusViewModel
 * @package App\Infrastracture\GuildMember
 */
class SkillAcquisitionStatusViewModel
{

    /**
     * SkillAcquisitionStatusViewModel constructor.
     * @param SkillAcquisitionStatus $status
     */
    public function __construct(SkillAcquisitionStatus $status)
    {
        $this->skillAcquisitionStatus = $status;
        $this->status = $status->status();
    }

    /**
     * @return string
     */
    public function toJa(): string
    {
        switch ($this->skillAcquisitionStatus) {
            case SkillAcquisitionStatus::NOT_LEARNED(): return '未習得'; break;
            case SkillAcquisitionStatus::LEARNED(): return '習得済み'; break;
        }
    }

    /**
     * @return bool
     */
    public function isNotLearned(): bool
    {
        return $this->skillAcquisitionStatus->isNotLearned();
    }

    /**
     * @return bool
     */
    public function isLearned(): bool
    {
        return $this->skillAcquisitionStatus->isLearned();
    }
}