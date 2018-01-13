<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/17
 * Time: 15:30
 */

namespace App\Domain\GuildMember;

use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\JobAcquisitionStatus;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\MemberJobStatus;
use App\Domain\GuildMember\ValueObjects\MemberSkillStatus;
use App\Domain\GuildMember\ValueObjects\SkillAcquisitionStatus;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\Course\Course;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Job\Job;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\Job\ValueObjects\JobId;
use App\Domain\PossessionJob\GetJobSpec;
use App\Domain\PossessionJob\PossessionJob;
use App\Domain\PossessionJob\PossessionJobCollection;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;
use App\Exceptions\DomainException;


class GuildMember
{
    /* @var PossessionSkillFactory $possessionSkillFactory */
    protected $possessionSkillFactory;
    /* @var \App\Domain\Course\RepositoryInterface\CourseRepositoryInterface */
    protected $courseRepo;
    /* @var PartyRepositoryInterface $partyRepository*/
    protected $partyRepository;
    /* @var SkillRepositoryInterface $skillRepo */
    protected $skillRepo;
    /* @var JobRepositoryInterface $jobRepo */
    protected $jobRepo;

    private $studentNumber;
    private $studentName;
    private $courseId;
    private $gender;
    private $mailAddress;
    private $possessionSkillCollection;
    private $favoriteJobId;
    private $possessionJobCollection;

    public function __construct()
    {
        $this->courseRepo = app(CourseRepositoryInterface::class);
        $this->possessionSkillFactory = app(PossessionSkillFactory::class);
        $this->partyRepository = app(PartyRepositoryInterface::class);
        $this->skillRepo = app(SkillRepositoryInterface::class);
        $this->jobRepo = app(JobRepositoryInterface::class);
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

    public function favoriteJobId(): ?JobId
    {
        return $this->favoriteJobId;
    }

    public function setFavoriteJob(JobId $jobId)
    {
        if(is_null($this->possessionJobs()->findPossessionJob($jobId))) throw new DomainException("{$jobId->code()} not learned");
        $this->favoriteJobId = $jobId;
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

    // 管理しているパーティ一覧を取得
    public function managedParties(): array
    {
        return $this->partyRepository->findListByManagerId($this->studentNumber);
    }

    public function skillAcquisitionList(): array
    {
        $allSkill = $this->skillRepo->all();

        return array_map(function(Skill $skill) {
            $possessionSkill = $this->possessionSkills()->findPossessionSkill($skill->skillId());
            if(is_null($possessionSkill)) {
                $status = SkillAcquisitionStatus::NOT_LEARNED();
                return new MemberSkillStatus($skill->skillId(), $status);
            } else {
                $status = SkillAcquisitionStatus::LEARNED();
                return new MemberSkillStatus($skill->skillId(), $status, $possessionSkill);
            }
        }, $allSkill);
    }

    public function jobAcquisitionList(): array
    {
        $exceptStudentJobs = $this->jobRepo->exceptStudent();

        return array_map(function(Job $job) {
            $possessionJob = $this->possessionJobs()->findPossessionJob($job->jobId());
            if(is_null($possessionJob) && GetJobSpec::validateRequirement($this->possessionSkills(), $job)) {
                $status = JobAcquisitionStatus::gettable();
                return new MemberJobStatus($job->jobId(), $status);
            } else if(is_null($possessionJob)) {
                $status = JobAcquisitionStatus::notLearned();
                return new MemberJobStatus($job->jobId(), $status);
            } else {
                $status = JobAcquisitionStatus::learned();
                return new MemberJobStatus($job->jobId(), $status);
            }
        }, $exceptStudentJobs);
    }
}