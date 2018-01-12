<?php

namespace Tests;

use App\Domain\Job\JobRepositoryInterface;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use Sampler;

    private $skillRepo;
    private $jobRepo;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh', [
            '--seed' => true
        ]);
        $this->skillRepo = app(SkillRepositoryInterface::class);
        $this->jobRepo = app(JobRepositoryInterface::class);
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }

    public function skillRepo(): SkillRepositoryInterface
    {
        return $this->skillRepo;
    }

    public function jobRepo(): JobRepositoryInterface
    {
        return $this->jobRepo;
    }
}
