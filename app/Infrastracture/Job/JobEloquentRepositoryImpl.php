<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/05
 * Time: 18:50
 */

namespace App\Infrastracture\Job;


use App\Domain\GetCondition\GetCondition;
use App\Domain\Job\Job;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\Job\ValueObjects\JobId;
use App\DomainUtility\RandomStringGenerator;
use App\Eloquents\GetConditionEloquent;
use App\Eloquents\JobEloquent;

class JobEloquentRepositoryImpl implements JobRepositoryInterface
{
    public function findById(string $code): ?Job
    {
        $jobModel = JobEloquent::findById($code);
        if(is_null($jobModel)) return null;
        return $jobModel->toEntity();
    }

    public function nextId(): JobId
    {
        do{
            $randId = RandomStringGenerator::makeLowerCase(4);
        }while(!is_null(JobEloquent::findById($randId)));

        $jobId = new JobId($randId);

        return $jobId;
    }

    public function save(Job $job): bool
    {
        JobEloquent::saveDomainObject($job);
        GetConditionEloquent::saveManyDomainObject($job->getConditions(), $job->jobId());

        return true;
    }

    public function all(): array
    {
        $jobModels = JobEloquent::all();

        $jobCollection = $jobModels->map(function(JobEloquent $eloquent) {
            return $eloquent->toEntity();
        });
        return $jobCollection->toArray();
    }
}