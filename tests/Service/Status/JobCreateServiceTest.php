<?php

namespace Tests\Service\Status;

use App\Domain\Status\ValueObject\JobInfo;
use App\Services\Status\JobCreateService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tests\TestCase;

class JobCreateServiceTest extends TestCase
{
    use SampleFactoryTrait;

    protected $service;

    protected function setUp()
    {
        parent::setUp();
        $this->service = App(JobCreateService::class);
    }

    public function testCreate()
    {
        $jobInfo = new JobInfo([
            "jobCode" => "job" . Str::random(4),
            "name" => "Job1",
            "imageUrl" => "https://placehold.jp/150x150.png",
            "memo" => "メモ"
        ]);


        $this->service->create($jobInfo);

        $this->assertTrue(true);
    }

    public function testAddRequiredSkill()
    {
        $job = $this->sampleJob();
        $skill = $this->sampleSkill();
        $requiredLevel = 1;

        $this->service->addRequiredSkill($job, $skill, $requiredLevel);

        $this->assertTrue(true);
    }
}