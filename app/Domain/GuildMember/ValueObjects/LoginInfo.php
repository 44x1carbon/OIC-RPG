<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/24
 * Time: 15:00
 */

namespace App\Domain\GuildMember\ValueObjects;

use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\PassWord;
use PhpParser\Node\Scalar\String_;


class LoginInfo
{
    private $address;
    private $password;

    public function __construct(MailAddress $address, PassWord $passWord)
    {
        $this->address = $address;
        $this->password = $passWord;
    }

    public function address(): MailAddress
    {
        return $this->address;
    }

    public function password(): PassWord
    {
        return $this->password;
    }
}