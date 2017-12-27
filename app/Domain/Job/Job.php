<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/28
 * Time: 11:42
 */

namespace App\Domain\Job;


use App\Domain\GetCondition\GetCondition;
use App\Domain\Job\ValueObjects\JobId;
use App\Domain\Job\ValueObjects\JobImage;

class Job
{
    private $jobId;
    private $jobName;
    private $imagePath;
    private $getConditions;

    public function __construct(JobId $jobId, string $jobName, string $imagePath, array $getConditions)
    {
        $this->jobId = $jobId;
        $this->jobName = $jobName;
        $this->imagePath = $imagePath;
        $this->getConditions = $getConditions;
    }

    public function jobId(): JobId
    {
        return $this->jobId;
    }

    public function jobName(): string
    {
        return $this->jobName;
    }

    public function imagePath(): string
    {
        return $this->imagePath;
    }

    public function getConditions(): array
    {
        return $this->getConditions;
    }
}