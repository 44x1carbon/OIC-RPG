<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/24
 * Time: 15:05
 */

namespace App\Domain\GuildMember\Spec;

use App\DomainUtility\SpecTrait;
use App\Domain\GuildMember\ValueObjects\MailAddress;


class MailAddressSpec
{
    use SpecTrait;

    const DOMAIN = '@oic.jp';
    const LOCAL_LENGTH = 5;
    const DOMAIN_LENGTH = 7;
    const MAX_LENGTH = self::LOCAL_LENGTH + self::DOMAIN_LENGTH;

    public static function isAvailable(String $address): bool
    {
        //受け取ったアドレスに@oic.jpがあるかどうか
        if(strlen($address) != self::MAX_LENGTH)return false;
        return substr($address,-self::DOMAIN_LENGTH,self::DOMAIN_LENGTH) === self::DOMAIN;
    }
}