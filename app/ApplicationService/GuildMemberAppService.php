<?php

namespace App\ApplicationService;

use App\Domain\Course\Course;
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

    function __construct(GuildMemberFactory $factory, GuildMemberRepositoryInterface $repository)
    {
        $this->factory = $factory;
        $this->repository = $repository;
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
        $guildMember = $this->factory->createGuildMember(
            $studentNumber,
            $studentName,
            $course,
            $gender,
            $mailAddress
        );

        if($this->repository->save($guildMember)) {
            return AuthData::registerMember($loginInfo);
        } else {
            throw new \Exception('[ApplicationService] Guild Member Register Error');
        }
    }
}