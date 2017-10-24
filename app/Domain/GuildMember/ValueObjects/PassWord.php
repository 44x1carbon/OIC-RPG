<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/24
 * Time: 15:01
 */

namespace App\Domain\GuildMember\ValueObjects;

use App\Domain\GuildMember\Spec\PassWordSpec;
use App\Exceptions\DomainException;

class PassWord
{
    private $password;

    public function __construct(String $password)
    {
        if( !PasswordSpec::isAvailable($password) ) throw new DomainException("Error");
        $this->password = $password;
    }

    public function password(): String
    {
        return $this->password;
    }
}