<?php

namespace Tests;

use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use Sampler;

    private $skillRepo;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh', [
            '--seed' => true
        ]);
        $this->skillRepo = app(SkillRepositoryInterface::class);
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
}
