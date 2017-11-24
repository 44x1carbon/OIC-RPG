<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/27
 * Time: 12:16
 */

namespace App\Domain\GuildMember\Spec;


use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\DomainUtility\SpecTrait;
use TypeError;

class GuildMemberSpec
{
    use SpecTrait;

    public static function isExistStudentNumber(StudentNumber $studentNumber): bool
    {
        /* @var GuildMemberRepositoryInterface $repo */
        $repo = app(GuildMemberRepositoryInterface::class);
        $guildMember = $repo->findByStudentNumber($studentNumber);
        return $guildMember !== null;
    }

    public static function isCompleteItem(GuildMember $guildMember): bool
    {
        try{
            $guildMember->studentNumber();
            $guildMember->studentName();
            $guildMember->course();
            $guildMember->gender();
            $guildMember->mailAddress();
            return true;
        }catch (TypeError $e){
            return false;
        }
    }
}