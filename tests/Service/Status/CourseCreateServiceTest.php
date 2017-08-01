<?php

namespace Tests\Service\Status;

use App\Domain\Status\ValueObject\CourseInfo;
use App\Services\Status\CourseCreateService;
use Illuminate\Support\Str;
use Tests\TestCase;

class CourseCreateServiceTest extends TestCase
{
    use SampleFactoryTrait;

    /* @var CourseCreateService $service*/
    protected $service;

    protected function setUp()
    {
        parent::setUp();
        $this->service = App(CourseCreateService::class);
    }

    public function testCreate()
    {
        $info = new CourseInfo([
            "name" => "コース1",
            "courseCode" => "it" . Str::random(4)
        ]);

        $this->service->create($info);

        $this->assertTrue(true);
    }

    public function testAddGettableSkill()
    {
        $course = $this->sampleCourse();
        $skill = $this->sampleSkill();

        $this->service->addGettableSkill($course, $skill);

        $this->assertTrue(true);
    }
}