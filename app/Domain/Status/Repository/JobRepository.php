<?php

namespace App\Domain\Status\Repository;

use App\Domain\Status\Eloquents\JobEloquent;
use App\Domain\Status\Eloquents\SkillEloquent;
use App\Domain\Status\Entity\Job;
use App\Domain\Status\Entity\RequiredSkill;
use App\Domain\Status\Entity\Skill;
use App\Domain\Status\ValueObject\JobInfo;
use App\Domain\Status\ValueObject\SkillInfo;


class JobRepository
{
    protected $jobModel;
    protected $skillModel;

    function __construct(JobEloquent $jobModel, SkillEloquent $skillModel)
    {
        $this->jobModel = $jobModel;
        $this->skillModel = $skillModel;
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

    function addRequiredSkill(Job $job, Skill $skill, int $requiredLevel):RequiredSkill
    {
        $jobModel = $this->jobModel->fromEntity($job);
        $skillModel = $this->skillModel->fromEntity($skill);

        $requiredModel =  $jobModel->requiredSkills()->create([
            "skill_id" => $skillModel->id,
            "required_level" => $requiredLevel
        ]);

        return $requiredModel->toEntity();
    }
}