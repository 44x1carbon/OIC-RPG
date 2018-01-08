<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2018/01/04
 * Time: 2:03
 */

namespace App\Infrastracture\GuildMember;


use App\Domain\GuildMember\ValueObjects\JobAcquisitionStatus;

/**
 * Class JobAcquisitionStatusViewModel
 * @package App\Infrastracture\GuildMember
 */
class JobAcquisitionStatusViewModel
{
    private $jobAcquisitionStatus;

    /**
     * JobAcquisitionStatusViewModel constructor.
     * @param JobAcquisitionStatus $status
     */
    public function __construct(JobAcquisitionStatus $jobAcquisitionStatus)
    {
        $this->jobAcquisitionStatus = $jobAcquisitionStatus;
        $this->status = $jobAcquisitionStatus->status();
    }

    /**
     * @return string
     */
    public function toJa(): string
    {
        switch ($this->status) {
            case JobAcquisitionStatus::LEARNED: return '習得済み'; break;
            case JobAcquisitionStatus::NOT_LEARNED: return '未習得'; break;
            case JobAcquisitionStatus::GETTABLE: return '習得可能'; break;
        }
    }

    /**
     * @return bool
     */
    public function isLearned(): bool
    {
        return $this->jobAcquisitionStatus->isLearned();
    }

    /**
     * @return bool
     */
    public function isNotLearned(): bool
    {
        return $this->jobAcquisitionStatus->isNotLearned();
    }

    /**
     * @return bool
     */
    public function isGettable(): bool
    {
        return $this->jobAcquisitionStatus->isGettable();
    }
}