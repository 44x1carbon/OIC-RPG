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
    protected $jobEloquent;
    protected $getConditionEloquent;

    public function __construct(JobEloquent $jobEloquent, GetConditionEloquent $getConditionEloquent)
    {
        $this->jobEloquent = $jobEloquent;
        $this->getConditionEloquent = $getConditionEloquent;
    }

    public function findById(string $code): ?Job
    {
        $jobModel = $this->jobEloquent->findById($code);
        if(is_null($jobModel)) return null;
        return $jobModel->toEntity();
    }

    public function nextId(): JobId
    {
        do{
            $randId = RandomStringGenerator::makeLowerCase(4);
        }while(!is_null($this->jobEloquent->findById($randId)));

        $jobId = new JobId($randId);

        return $jobId;
    }

    public function save(Job $job): bool
    {
        $this->jobEloquent->saveDomainObject($job);
        $this->getConditionEloquent->saveManyDomainObject($job->getConditions(), $job->jobId());

        return true;
    }

    public function all(): array
    {
        $jobModels = $this->jobEloquent->all();

        $jobCollection = $jobModels->map(function(JobEloquent $eloquent) {
            return $eloquent->toEntity();
        });
        return $jobCollection->toArray();
    }
}