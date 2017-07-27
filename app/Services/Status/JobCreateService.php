<?php

namespace App\Services\Status;

use App\Domain\Status\Entity\Job;
use App\Domain\Status\Repository\JobRepository;
use App\Domain\Status\ValueObject\JobInfo;

class JobCreateService
{
    protected $repo;

    function __construct(JobRepository $repo)
    {
        $this->repo = $repo;
    }

    function create(JobInfo $info):Job
    {
        return $this->repo->create($info);
    }
}