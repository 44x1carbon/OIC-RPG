<?php

namespace App\Infrastracture\GuildMember;


use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\Field\FieldRepositoryInterface;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\MemberJobStatus;
use App\Domain\GuildMember\ValueObjects\MemberSkillStatus;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Infrastracture\Course\CourseViewModel;
use App\Infrastracture\Field\FieldViewModel;
use App\Infrastracture\Job\JobViewModel;
use App\Infrastracture\PossessionSkill\PossessionSkillViewModel;

class GuildMemberViewModel
{
    private $guildMember;
    /* @var JobRepositoryInterface $jobRepo */
    private $jobRepo;
    /* @var CourseRepositoryInterface $courseRepo */
    private $courseRepo;
    /* @var FieldRepositoryInterface $fieldRepo */
    private $fieldRepo;
    private $favoriteJob = null;
    private $possessionSkills = null;
    private $course = null;
    private $field = null;
    private $skillStatusList = null;
    private $jobStatusList = null;

    /**
     * GuildMemberViewModel constructor.
     * @param GuildMember $guildMember
     */
    public function __construct(GuildMember $guildMember)
    {
        $this->guildMember = $guildMember;
        $this->studentNumber = $guildMember->studentNumber()->code();
        $this->name = $guildMember->studentName();
        $this->gender = new GenderViewModel($guildMember->gender());
        $this->maillAddress = $guildMember->mailAddress()->address();

        $this->fieldRepo = app(FieldRepositoryInterface::class);
        $this->courseRepo = app(CourseRepositoryInterface::class);
        $this->jobRepo = app(JobRepositoryInterface::class);
    }

    /**
     * @return JobViewModel
     */
    public function favoriteJob(): JobViewModel
    {
        if(is_null($this->favoriteJob)) {
            $favoriteJob = $this->jobRepo->findById($this->guildMember->favoriteJobId()->code());
            $this->favoriteJob = new JobViewModel($favoriteJob);
        }

        return $this->favoriteJob;
    }

    /**
     * @return array
     */
    public function possessionSkills(): array
    {
        if(is_null($this->possessionSkills)) {
            $this->possessionSkills = array_map(function(PossessionSkill $possessionSkill) {
                return new PossessionSkillViewModel($possessionSkill);
            }, (array) $this->guildMember->possessionSkills());
        }
    }

    /**
     * @return CourseViewModel
     */
    public function course(): CourseViewModel
    {
        if(is_null($this->course)) {
            $course  = $this->guildMember->course();
            $this->course = new CourseViewModel($course);
        }

        return $this->course;
    }

    /**
     * @return FieldViewModel
     */
    public function field(): FieldViewModel
    {
        if(is_null($this->field)) {
            $course  = $this->guildMember->course();
            $field = $this->fieldRepo->findByCourseId($course->id());
            $this->field = new FieldViewModel($field);
        }

        return $this->field;
    }

    /**
     * @return array
     */
    public function skillStatusList(): array
    {
        if(is_null($this->skillStatusList)) {
            $this->skillStatusList = array_map(function(MemberSkillStatus $status) {
                return new MemberSkillStatusViewModel($status);
            }, $this->guildMember->skillAcquisitionList());
        }

        return $this->skillStatusList;
    }

    /**
     * @return array
     */
    public function jobStatusList(): array
    {
        if(is_null($this->jobStatusList)) {
            $this->jobStatusList = array_map(function(MemberJobStatus $status) {
                return new MemberJobStatusViewModel($status);
            }, $this->guildMember->jobAcquisitionList());
        }

        return $this->jobStatusList;
    }
}
