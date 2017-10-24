<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/24
 * Time: 15:01
 */

namespace App\Domain\GuildMember\ValueObjects;

use App\Domain\GuildMember\Spec\MailAddressSpec;
use App\Exceptions\DomainException;


class MailAddress
{
    private $address;

    public function __construct(String $address)
    {
        if( !MailAddressSpec::isAvailable($address) ) throw new DomainException("Error");
        $this->address = $address;
    }

    public function address(): String
    {
        return $this->address;
    }
}