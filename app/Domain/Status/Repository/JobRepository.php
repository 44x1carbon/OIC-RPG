<?php

namespace App\Domain\Status\Repository;

use App\Domain\Status\Eloquents\JobEloquent;
use App\Domain\Status\Entity\Job;
use App\Domain\Status\ValueObject\JobInfo;


class JobRepository
{
    protected $jobModel;

    function __construct(JobEloquent $jobModel)
    {
        $this->jobModel = $jobModel;
    }

    function create(JobInfo $info):Job
    {
        $data = [
            "job_code" => $info->jobCode,
            "name" => $info->name,
            "image_url" => $info->imageUrl,
            "memo" => $info->memo
        ];
        $jobModel = $this->jobModel->create($data);

        return $jobModel->toEntity();
    }
}