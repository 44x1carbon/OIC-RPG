<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/05
 * Time: 18:15
 */

namespace App\ApplicationService;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\Job;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\Job\ValueObjects\JobId;

class JobApplicationService
{
    protected $jobRepository;
  
    public function __construct()
    {
        $this->jobRepository = app(JobRepositoryInterface::class);
    }

    public function registerJob(string $jobName, string $imagePath, array $getConditions): JobId
    {
        $jobId = $this->jobRepository->nextId();
        $job = new Job($jobId, $jobName, $imagePath, $getConditions);

        $this->jobRepository->save($job);

        return $job->jobId();
    }
}