<?php

namespace App\Domain\GuildMember\ValueObjects;

use App\Domain\Job\ValueObjects\JobId;

/**
 * Class MemberJobStatus
 * @package App\Domain\GuildMember\ValueObjects
 */
class MemberJobStatus
{
    private $jobId;
    private $status;

    /**
     * MemberJobStatus constructor.
     * @param JobId $jobId
     * @param JobAcquisitionStatus $status
     */
    public function __construct(JobId $jobId, JobAcquisitionStatus $status)
    {
        $this->jobId = $jobId;
        $this->status = $status;
    }

    /**
     * @return JobId
     */
    public function jobId(): JobId
    {
        return $this->jobId;
    }

    /**
     * @return JobAcquisitionStatus
     */
    public function status(): JobAcquisitionStatus
    {
        return $this->status;
    }


}