<?php

namespace App\Presentation\DTO;

use App\Domain\Job\JobRepositoryInterface;
use Illuminate\Contracts\Support\Arrayable;

class WantedRoleDto
{
    // 募集役割名
    public $roleName;
    // 備考
    public $remarks;
    // 参考ジョブID
    public $referenceJobId;
    // 参考ジョブ名
    public $referenceJobName;
    // 枠数
    public $frameAmount;

    public $managerAssigned;

    function __construct(string $roleName = null, string $remarks = null, string $referenceJobId = null, int $frameAmount = null, bool $managerAssigned = false)
    {
        $jobRepo = app(JobRepositoryInterface::class);
        $referenceJob = null;
        if(!is_null($referenceJobId)) $referenceJob = $jobRepo->findById($referenceJobId);

        $this->roleName = $roleName;
        $this->remarks = $remarks;
        $this->referenceJobId = $referenceJobId;
        $this->frameAmount = $frameAmount;
        $this->referenceJobName = null_safety($referenceJob, function($job) { return $job->jobName(); });
        $this->managerAssigned = $managerAssigned;
    }

    /**
     * @return string
     */
    public function roleName(): string
    {
        return $this->roleName ?? '';
    }

    /**
     * @return string
     */
    public function remarks(): string
    {
        return $this->remarks ?? '';
    }

    /**
     * @return string
     */
    public function referenceJobId(): string
    {
        return $this->referenceJobId ?? '';
    }

    /**
     * @return int
     */
    public function frameAmount(): int
    {
        return $this->frameAmount ?? 0;
    }

    /**
     * @return bool
     */
    public function managerAssigned(): bool
    {
        return $this->managerAssigned ?? false;
    }


}