<?php

namespace App\Domain\GuildMember\Factory;

use App\Domain\Course\Course;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\Spec\GuildMemberSpec;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Exceptions\DomainException;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/27
 * Time: 12:42
 */

class GuildMemberFactory
{
    public function __construct()
    {

    }

    public function createGuildMember(StudentNumber $studentNumber, String $studentName, Course $course, Gender $gender,MailAddress $mailAddress): GuildMember
    {
        $guildMember = new GuildMember();
        $guildMember->setStudentNumber($studentNumber);
        $guildMember->setStudentName($studentName);
        $guildMember->setCourse($course);
        $guildMember->setGender($gender);
        $guildMember->setMailAddress($mailAddress);

        if (!GuildMemberSpec::isCompleteItem($guildMember)) throw new DomainException("Error");

        return $guildMember;
    }
}