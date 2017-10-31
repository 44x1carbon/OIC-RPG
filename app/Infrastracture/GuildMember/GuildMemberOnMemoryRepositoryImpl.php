<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/27
 * Time: 11:21
 */

namespace App\Infrastracture\GuildMember;

use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\StudentNumber;

class GuildMemberOnMemoryRepositoryImpl implements GuildMemberRepositoryInterface
{
    private $data = [];

    public function findByLoginInfo(LoginInfo $loginInfo): ?GuildMember
    {
        $result = array_filter($this->data, function(GuildMember $guildMember) use($loginInfo){
            return $guildMember->mailAddress() == $loginInfo->address();
        });

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function findByStudentNumber(StudentNumber $studentNumber): ?GuildMember
    {
        $result = array_filter($this->data, function(GuildMember $guildMember) use($studentNumber){
            //dd($studentNumber);
            return $guildMember->studentNumber() == $studentNumber;
        });

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(GuildMember $guildMember): bool
    {
        $this->data[] = $guildMember;
        return true;
    }

    public function all(): array
    {
        return $this->data;
    }
}