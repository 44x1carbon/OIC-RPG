<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/28
 * Time: 13:17
 */

namespace App\Domain\Job\Factory;


use App\Domain\GetCondition\GetCondition;
use App\Domain\Job\Job;
use App\Domain\Job\ValueObjects\JobImage;

class JobFactory
{
    public function createJob(string $jobName, JobImage $jobImage, GetCondition $getCondition)
    {
        $job = new Job();
        $job->setJobId();
        $job->setJobName($jobName);
        $job->setImage($jobImage);
        $job->setGetCondition($getCondition);
        return $job;
    }
}