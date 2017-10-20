<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/20
 * Time: 11:05
 */

namespace App\Domain\GuildMember\ValueObjects;

use App\Domain\GuildMember\Spec\GenderSpec;

class Gender
{
    // 性別を定数として定義
    //

    const MALE = 'male';
    const FEMALE = 'female';
    const TYPE_LIST = [self::MALE, self::FEMALE];

    private $type;

    public function __construct(String $type)
    {
        $this->type = $type;
        if( !GenderSpec::isAvailable($type) ) throw new \Exception("Error");

    }
}