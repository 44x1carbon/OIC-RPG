<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/28
 * Time: 11:42
 */

namespace App\Domain\Job;


use App\Domain\GetCondition\GetCondition;
use App\Domain\Job\ValueObjects\JobImage;

class Job
{
    private $jobId;
    private $jobName;
    private $image;
    private $getCondition;

    public function __construct()
    {
    }

    public function setJobId(string $JobId)
    {
        $this->jobId = $JobId;
    }

    public function setJobName(string $jobName)
    {
        $this->jobName = $jobName;
    }

    public function setImage(JobImage $jobImage)
    {
        $this->image = $jobImage;
    }

    public function setGetCondition(GetCondition $getCondition)
    {
        $this->getCondition = $getCondition;
    }

    public function jobId(): string
    {
        return $this->jobId;
    }

    public function jobName(): string
    {
        return $this->jobName;
    }

    public function image(): JobImage
    {
        return $this->image;
    }

    public function getCondition(): GetCondition
    {
        return $this->getCondition;
    }
}