<?php

namespace Tests\Service\Status;

use App\Domain\Status\Eloquents\SkillEloquent;
use App\Domain\Status\Entity\Course;
use App\Domain\Status\Entity\Student;
use App\Domain\Status\ValueObject\SkillInfo;
use App\Domain\Status\ValueObject\StudentInfo;
use App\Services\Status\StudentCreateService;
use Illuminate\Support\Str;
use Tests\TestCase;

class StudentCreateServiceTest extends TestCase
{
    use SampleFactoryTrait;

    protected $service;

    protected function setUp()
    {
        parent::setUp();
        $this->service = App(StudentCreateService::class);
    }

    public function testCreate()
    {
        $course = $this->sampleCourse();
        $studentInfo = new StudentInfo([
            "name" => "山田 太郎",
            "studentCode" => "b" . Str::random(3),
            "belongClass" => "9A"
        ]);

        $student = $this->service->create($studentInfo, $course);

        $this->assertTrue(true);
    }

    public function testAddSkill()
    {
        $student = $this->sampleStudent();

        $skillModel = SkillEloquent::create([
            "skill_code" => Str::random(8),
            "name" => "スキル" . Str::random(4),
            "memo" => Str::random(40)
        ]);

        $skillInfo = new SkillInfo([
            "skillCode" => $skillModel->skill_code,
            "name" => $skillModel->name,
            "memo" => $skillModel->memo,
        ]);

//        dd($skillModel, $skillInfo);

        $this->service->addSkill($student, $skillInfo);
        $this->assertTrue(true);
    }

    public function testAddExp()
    {
        $student = $this->sampleStudent();
        $studentSkill = $this->sampleStudentSkill($student);
        $this->service->addExp($studentSkill, 100);
        $this->assertTrue(true);
    }

    public function testAddJob()
    {
        $student = $this->sampleStudent();
        $job = $this->sampleJob();
        $this->service->addJob($student, $job);
        $this->assertTrue(true);
    }
}