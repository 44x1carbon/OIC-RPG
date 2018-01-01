<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/17
 * Time: 15:30
 */

namespace App\Domain\GuildMember;

use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\Course\Course;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\Job\Job;
use App\Domain\PossessionJob\PossessionJob;
use App\Domain\PossessionJob\PossessionJobCollection;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Infrastracture\Course\CourseOnMemoryRepositoryImpl;
use ArrayObject;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Scalar\String_;


class GuildMember
{
    /* @var PossessionSkillFactory $possessionSkillFactory */
    protected $possessionSkillFactory;
    /* @var \App\Domain\Course\RepositoryInterface\CourseRepositoryInterface */
    protected $courseRepo;
    private $studentNumber;
    private $studentName;
    private $courseId;
    private $gender;
    private $mailAddress;
    private $possessionSkillCollection;
    private $possessionJobCollection;

    public function __construct()
    {
        $this->courseRepo = app(CourseRepositoryInterface::class);
        $this->possessionSkillFactory = app(PossessionSkillFactory::class);
    }

//  学籍番号VOをセット
    public function setStudentNumber(StudentNumber $studentNumber)
    {
        $this->studentNumber = $studentNumber;
    }

//  学生の名前をセット
    public function setStudentName(string $studentName)
    {
        $this->studentName = $studentName;
    }
//  コースIDをセット
    public function setCourse(Course $course)
    {
        $this->courseId = $course->id();
    }

//  学生の性別をセット
    public function setGender(Gender $gender)
    {
        $this->gender = $gender;
    }

//  メールアドレスをセット
    public function setMailAddress(MailAddress $mailAddress)
    {
        $this->mailAddress = $mailAddress;
    }

    public function setPossessionSkills(PossessionSkillCollection $possessionSkillCollection)
    {
        $this->possessionSkillCollection = $possessionSkillCollection;
    }

    public function setPossessionJobs(PossessionJobCollection $possessionJobCollection)
    {
        $this->possessionJobCollection = $possessionJobCollection;
    }

//  学籍番号をゲット
    public function studentNumber(): StudentNumber
    {
        return $this->studentNumber;
    }

//  名前をゲット
    public function studentName(): string
    {
        return $this->studentName;
    }

//  最新コースをゲット
    public function course(): Course
    {
        //dd($this->courseId);
        return $this->courseRepo->findById($this->courseId);
    }

//  性別をゲット
    public function gender(): Gender
    {
        return $this->gender;
    }

//  メールアドレスをゲット
    public function mailAddress(): MailAddress
    {
        return $this->mailAddress;
    }

    public function possessionSkills(): ?PossessionSkillCollection
    {
        return $this->possessionSkillCollection;
    }

    public function possessionJobs(): ?PossessionJobCollection
    {
        return $this->possessionJobCollection;
    }

    public function learnSkill(string $skillId): PossessionSkill
    {
        $possessionSkill = $this->possessionSkillFactory->createPossessionSkill($skillId, $this->studentNumber);
        $this->possessionSkills()->append($possessionSkill);
        return $possessionSkill;
    }

    public function getJob(Job $job): PossessionJob
    {
        $possessionJob = new PossessionJob($this->studentNumber(), $job->jobId());
        $this->possessionJobs()->append($possessionJob);
        return $possessionJob;
    }

    public function gainExp(PossessionSkill $possessionSkill, int $exp): PossessionSkill
    {
        $addResultPossessionSkill = PossessionSkill::AddExp($possessionSkill, $exp);
        $addResultPossessionSkill = PossessionSkill::levelUp($possessionSkill, $addResultPossessionSkill);

        return $addResultPossessionSkill;
    }
}