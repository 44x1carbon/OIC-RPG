<?php

namespace App\ApplicationService;

use App\Domain\Course\Course;
use App\Domain\Field\FieldRepositoryInterface;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Infrastracture\AuthData\AuthData;
use Illuminate\Auth\Events\Login;

class  GuildMemberAppService
{
    protected $factory;
    protected $repository;

    function __construct(GuildMemberFactory $factory, GuildMemberRepositoryInterface $repository, FieldRepositoryInterface $fieldRepository)
    {
        $this->factory = $factory;
        $this->repository = $repository;
        $this->fieldRepository = $fieldRepository;
    }


    public function registerMember(
        StudentNumber $studentNumber,
        string $studentName,
        Course $course,
        Gender $gender,
        MailAddress $mailAddress,
        LoginInfo $loginInfo
    )
    {
        $field = $this->fieldRepository->findByCourseId($course->id());
        $defaultJob = $field->defaultJob();

        $guildMember = $this->factory->createGuildMember(
            $studentNumber,
            $studentName,
            $course,
            $gender,
            $mailAddress,
            $defaultJob->jobId()
        );

        if($this->repository->save($guildMember)) {
            return AuthData::registerMember($loginInfo);
        } else {
            throw new \Exception('[ApplicationService] Guild Member Register Error');
        }
    }
}