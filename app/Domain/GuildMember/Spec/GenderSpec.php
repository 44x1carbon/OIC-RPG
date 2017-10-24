<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/20
 * Time: 11:15
 */

namespace App\Domain\GuildMember\Spec;

use App\Domain\GuildMember\ValueObjects\Gender;
use App\DomainUtility\SpecTrait;

class GenderSpec
{
    use SpecTrait;

    public static function isAvailable(String $type): bool
    {
        //受け取った値が利用可能か判定
        //genderのリストと受け取り値を判定
        $list = Gender::TYPE_LIST;
        return in_array($type,$list);
    }
}