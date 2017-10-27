<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/27
 * Time: 11:21
 */

use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\GuildMember;

class GuildMemberOnMemoryRepositoryImpl implements GuildMemberRepositoryInterface
{
    private $data = [];

    public function findById(String $code): \App\Domain\GuildMember\ValueObjects\StudentNumber
    {
        $result = array_filter($this->data, function(GuildMember $guildMember) use($code){
            return $guildMember->studentNumber() === $code;
        });

        if(count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function save(\App\Domain\GuildMember\GuildMember $guildMember): bool
    {
        $this->data[] = $guildMember;
        return true;
    }

    public function all(): Array
    {
        return $this->data;
    }
}