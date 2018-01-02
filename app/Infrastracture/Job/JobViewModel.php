<?php

namespace App\Infrastracture\Job;

use App\Domain\GetCondition\GetCondition;
use App\Domain\Job\Job;

class JobViewModel
{
    private $job;
    private $getConditions = null;

    /**
     * JobViewModel constructor.
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
        $this->name = $job->jobName();
        $this->path = $job->imagePath();
    }

    /**
     * @return array
     */
    public function getConditions(): array
    {
        $this->getConditions = $this->getConditions ?? array_map(function(GetCondition $getCondition) {
            return new GetConditionViewModel($getCondition);
        }, $this->job->getConditions());

        return $this->getConditions;
    }

    /**
     * @return string
     */
    public function characterImagePath(): string
    {
        return asset( "/images/job/character/$this->path.png");
    }

    /**
     * @return string
     */
    public function iconImagePath(): string
    {
        return asset("/images/job/icon/$this->path.png");
    }

    /**
     * @return string
     */
    public function mypImagePath(): string
    {
        return asset("/images/job/myp/$this->path.png");
    }
}
