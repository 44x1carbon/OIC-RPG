<?php

namespace App\Infrastracture\GuildMember;

use App\Domain\GuildMember\ValueObjects\JobAcquisitionStatus;
use App\Domain\GuildMember\ValueObjects\MemberJobStatus;
use App\Domain\Job\JobRepositoryInterface;
use App\Infrastracture\Job\JobViewModel;

/**
 * Class MemberJobStatusViewModel
 * @package App\Infrastracture\GuildMember
 */
class MemberJobStatusViewModel
{
    private $memberJobStatus;
    private $job = null;
    /* @var JobRepositoryInterface $jobRepo */
    private $jobRepo;

    /**
     * MemberJobStatusViewModel constructor.
     * @param MemberJobStatus $status
     */
    public function __construct(MemberJobStatus $status)
    {
        $this->memberJobStatus = $status;
        $this->status = new JobAcquisitionStatusViewModel($status->status());
        $this->jobRepo = app(JobRepositoryInterface::class);
    }

    /**
     * @return JobViewModel
     */
    public function job(): JobViewModel
    {
        if(is_null($this->job)) {
            $job = $this->jobRepo->findById($this->memberJobStatus->jobId()->code());
            $this->job = new JobViewModel($job);
        }

        return $this->job;
    }
}