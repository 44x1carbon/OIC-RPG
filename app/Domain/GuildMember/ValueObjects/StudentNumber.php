<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/17
 * Time: 15:31
 */

namespace App\Domain\GuildMember\ValueObjects;


use App\Domain\GuildMember\Spec\StudentNumberSpec;
use PhpParser\Node\Scalar\String_;

class StudentNumber
{
    private $code;

    public function __construct(String $code)
    {
        $this->code = $code;

        if( !StudentNumberSpec::validateFormat($this) ) throw new \Exception("Error");

    }

    public function code(): String
    {
        return $this->code;
    }
}