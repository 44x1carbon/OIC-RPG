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
use App\Domain\Job\ValueObjects\JobId;

class JobServiceFacade
{
    public function registerJob(string $jobName, string $imagePath, array $getConditions): string
    {
        $_getConditions = [];

        /* @var GetCondition $getCondition */
        foreach ($getConditions as $getCondition)
        {
            $_getCondition = new GetCondition($getCondition->skillId(), $getCondition->requiredLevel());
            $_getConditions[] = $_getCondition;
        }

        $jobApplicationService = new JobApplicationService();
        /* @var $jobId JobId */
        $jobId = $jobApplicationService->registerJob($jobName, $imagePath, $_getConditions);
        return $jobId->code();
    }
}