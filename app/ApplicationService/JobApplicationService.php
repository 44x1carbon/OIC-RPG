<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/05
 * Time: 18:15
 */

namespace App\ApplicationService;


use App\Domain\GetCondition\GetCondition;
use App\Domain\Job\Job;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\Job\ValueObjects\JobId;

class JobApplicationService
{
    protected $jobRepository;

    public function registerJob(string $jobName, string $imagePath, array $getConditions): JobId
    {
        $jobRepository = app(JobRepositoryInterface::class);
        $jobId = $jobRepository->nextId();
        $job = new Job($jobId, $jobName, $imagePath, $getConditions);

        $jobRepository->save($job);

        return $job->jobId();
    }
}