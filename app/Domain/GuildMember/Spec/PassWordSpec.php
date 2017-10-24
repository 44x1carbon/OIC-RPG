<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/24
 * Time: 15:11
 */

namespace App\Domain\GuildMember\Spec;

use App\Domain\GuildMember\ValueObjects\PassWord;
use App\DomainUtility\SpecTrait;

class PassWordSpec
{
    use SpecTrait;

    const MIN_LENGTH = 8;

    public static function isAvailable(String $passtext): bool
    {
        if(strlen($passtext) < self::MIN_LENGTH) return false;
        return ctype_alnum($passtext);
    }
}