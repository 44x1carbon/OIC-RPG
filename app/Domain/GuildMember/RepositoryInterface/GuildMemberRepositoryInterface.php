<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/27
 * Time: 11:19
 */

namespace App\Domain\GuildMember\RepositoryInterface;


use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\StudentNumber;

interface GuildMemberRepositoryInterface
{
    public function findByLoginInfo(LoginInfo $loginInfo): ?GuildMember;

    public function findByStudentNumber(StudentNumber $studentNumber): ?GuildMember;

    public function save(GuildMember $guildMember): bool;

    public function all(): array;
}