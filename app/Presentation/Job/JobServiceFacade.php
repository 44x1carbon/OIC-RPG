<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/05
 * Time: 17:54
 */

namespace App\Presentation\Job;


use App\ApplicationService\JobApplicationService;
use App\Domain\GetCondition\GetCondition;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\ValueObjects\JobId;

class JobServiceFacade
{
    private $jobApplicationService;

    public function __construct()
    {
        $this->jobApplicationService = app(JobApplicationService::class);
    }

    public function registerJob(string $jobName, string $imagePath, array $getConditions): string
    {
        $_getConditions = [];

        /* @var GetCondition $getCondition */
        foreach ($getConditions as $getCondition)
        {
            $_getCondition = new GetCondition($getCondition->skillId(), $getCondition->requiredLevel());
            $_getConditions[] = $_getCondition;
        }

        /* @var $jobId JobId */
        $jobId = $this->jobApplicationService->registerJob($jobName, $imagePath, $_getConditions);
        return $jobId->code();
    }

    public function getJob(string $studentNumber, string $jobId): string
    {
        $_studentNumber = new StudentNumber($studentNumber);
        $_jobId = new JobId($jobId);

        $jobApplicationService = new JobApplicationService();

        /* @var $jobId JobId */
        $jobId = $jobApplicationService->getJob($_studentNumber, $_jobId);
        return $jobId->code();
    }
}