<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/17
 * Time: 15:42
 */

namespace App\Domain\GuildMember\Spec;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\DomainUtility\SpecTrait;

class StudentNumberSpec
{
    use SpecTrait;

    const MATTCH = ['b','B'];


    public static function validateFormat(String $code): bool
    {
        //Bから始まり数字四桁計5桁　BXXXX
        if(strlen($code) !== StudentNumber::MAX_LENGTH) return false;
        $initial = substr($code,0,1);
        if(!in_array($initial,StudentNumber::MATCH)) return false;
        if(!ctype_digit(substr($code,StudentNumber::ENGLISH_LENGTH,StudentNumber::DIGIT_LENGTH))) return false;
        
        return true;
    }
}