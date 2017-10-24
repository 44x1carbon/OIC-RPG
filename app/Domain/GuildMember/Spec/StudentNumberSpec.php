<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/17
 * Time: 15:42
 */

namespace App\Domain\GuildMember\Spec;

use App\DomainUtility\SpecTrait;

class StudentNumberSpec
{
    use SpecTrait;

    public static function validateFormat(String $code): bool
    {
        //Bから始まり数字四桁計5桁　BXXXX
        if(strlen($code) !== 5) return false;
        if(substr($code,0,1) !== 'B') return false;
        if(!ctype_digit(substr($code,1,4))) return false;
        
        return true;
    }
}