<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/24
 * Time: 16:06
 */

namespace App\Domain\PossessionJob;


use App\Domain\Job\Job;
use App\Domain\Job\ValueObjects\JobId;
use ArrayObject;
use InvalidArgumentException;

class PossessionJobCollection extends ArrayObject
{
    public function __construct(array $possessionJobs)
    {
        foreach ($possessionJobs as $possessionJob)
        {
            $this->append($possessionJob);
        }
    }

    function append($value)
    {
        if($value instanceof PossessionJob)
        {
            return parent::append($value);
        }
        throw new InvalidArgumentException;
    }

    public function findPossessionJob(JobId $jobId): ?PossessionJob
    {
        $result = array_filter((array) $this, function(PossessionJob $possessionJob) use($jobId){
            return $possessionJob->JobId()->code() === $jobId->code();
        });
        $result = array_values($result);
        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }
}