<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/25
 * Time: 7:02
 */

namespace App\ApplicationService;


use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\Job\ValueObjects\JobId;
use App\Domain\PossessionJob\GetJobSpec;
use App\Exceptions\DomainException;

class PossessionJobAppService
{
    protected $jobRepository;

    protected $guildMemberRepository;

    public function __construct(
        JobRepositoryInterface $repo,
        GuildMemberRepositoryInterface $guildMemberRepository
    )
    {
        $this->jobRepository = $repo;
        $this->guildMemberRepository = $guildMemberRepository;
    }

    public function getJob(StudentNumber $studentNumber, JobId $jobId): JobId
    {
        $job = $this->jobRepository->findById($jobId->code());
        $guildMember = $this->guildMemberRepository->findByStudentNumber($studentNumber);

        if(GetJobSpec::isExistPossessionJob($guildMember->possessionJobs(), $jobId)) throw new DomainException('取得済みです');
        if(!GetJobSpec::validateRequirement($guildMember->possessionSkills(), $job)) throw new DomainException('要件を満たしていません');

        $possessionJob = $guildMember->getJob($job);
        $this->guildMemberRepository->save($guildMember);

        return $possessionJob->jobId();
    }
}