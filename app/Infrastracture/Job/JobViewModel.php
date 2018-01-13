<?php

namespace App\Infrastracture\Job;

use App\Domain\Field\FieldRepositoryInterface;
use App\Domain\GetCondition\GetCondition;
use App\Domain\Job\Job;
use App\Infrastracture\Field\FieldViewModel;

/**
 * Class JobViewModel
 * @package App\Infrastracture\Job
 */
class JobViewModel
{
    private $job;
    private $getConditions = null;
    private $field = null;
    /* @var FieldRepositoryInterface $fieldRepo */
    private $fieldRepo;

    /**
     * JobViewModel constructor.
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
        $this->id = $job->jobId()->code();
        $this->name = $job->jobName();
        $this->path = $job->imagePath();

        $this->fieldRepo = app(FieldRepositoryInterface::class);
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

    /**
     * @return string
     */
    public function silhouettePath(): string
    {
        return asset("/images/job/silhouette/$this->path.png");
    }

    /**
     * @return FieldViewModel
     */
    public function field(): FieldViewModel
    {
        if(is_null($this->field)) {
            $field = $this->fieldRepo->findByJobId($this->job->jobId());
            $this->field = new FieldViewModel($field);
        }

        return $this->field;
    }
}
