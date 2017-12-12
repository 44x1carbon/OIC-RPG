<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/08
 * Time: 12:50
 */

namespace App\Eloquents;


use App\Domain\Job\ValueObjects\JobId;
use App\Domain\GetCondition\GetCondition;
use App\Job;
use Illuminate\Database\Eloquent\Model;

class GetConditionEloquent extends Model
{
    protected $table = 'get_conditions';

    public function findByJobId(string $jobId): ?array
    {
        $getConditionModel = $this->where('job_id', $jobId)->get();
        return $getConditionModel->toArray();
    }

    public function findByJobIdAndSkillId(string $jobId, string $skillId): ?GetConditionEloquent
    {
        $getConditionModel = $this->where('job_id', $jobId)->where('skill_id', $skillId)->first();
        return $getConditionModel;
    }

    public function fromValueObject(GetCondition $getCondition, JobId $jobId): GetConditionEloquent
    {
        $getConditionModel = $this->findByJobIdAndSkillId($jobId->code(), $getCondition->skillId());
        if(is_null($getConditionModel)) $getConditionModel = new GetConditionEloquent();

        $getConditionModel->job_id = $jobId->code();
        $getConditionModel->skill_id = $getCondition->skillId();
        $getConditionModel->required_level = $getCondition->requiredLevel();

        return $getConditionModel;
    }

    public function saveManyDomainObject(array $getConditions, JobId $jobId)
    {
        foreach ($getConditions as $getCondition)
        {
            $getConditionModel = $this->fromValueObject($getCondition, $jobId);
            $getConditionModel->save();
        }
    }
}