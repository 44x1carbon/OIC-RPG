<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/08
 * Time: 12:26
 */

namespace App\Eloquents;


use App\Domain\Job\Job;
use App\Domain\Job\ValueObjects\JobId;
use Illuminate\Database\Eloquent\Model;

class JobEloquent extends Model
{
    protected $table = 'jobs';

    public static function findById(string $id): ?JobEloquent
    {
        $jobModel = self::where('job_id', $id)->first();
        return $jobModel;
    }

    public static function fromEntity(Job $job): JobEloquent
    {
        $jobModel = self::findById($job->jobId()->code());
        if(is_null($jobModel)) $jobModel = new JobEloquent();

        $jobModel->job_id = $job->jobId()->code();
        $jobModel->job_name = $job->jobName();
        $jobModel->image_path = $job->imagePath();

        return $jobModel;
    }

    public function toEntity(): Job
    {
        $jobId = new JobId($this->job_id);

        $getConditionEloquent = new GetConditionEloquent();
        $getConditions = $getConditionEloquent->findByJobId($jobId->code());

        $entity = new Job(
          $jobId,
          $this->job_name,
          $this->image_path,
          $getConditions
        );

        return $entity;
    }

    public static function saveDomainObject(Job $job)
    {
        $jobModel = self::fromEntity($job);
        $jobModel->save();
    }
}