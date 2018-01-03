<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/24
 * Time: 16:29
 */

namespace App\Domain\PossessionJob;


use App\Domain\GetCondition\GetCondition;
use App\Domain\Job\Job;
use App\Domain\Job\ValueObjects\JobId;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\PossessionSkillCollection;

class GetJobSpec
{
    public static function validateRequirement(PossessionSkillCollection $possessionSkillCollection, Job $job): bool
    {
        /* @var GetCondition $getCondition */
        foreach ($job->getConditions() as $getCondition)
        {
            $possessionSkill = $possessionSkillCollection->findPossessionSkill($getCondition->skillId());
            if(!is_null($possessionSkill))
            {
                if($possessionSkill->skillLevel() < $getCondition->requiredLevel()) return false;
            } else return false;
        }
        return true;
    }

    public static function isExistPossessionJob(PossessionJobCollection $possessionJobCollection, JobId $jobId): bool
    {
        return !is_null($possessionJobCollection->findPossessionJob($jobId)) ? true : false;
    }
}