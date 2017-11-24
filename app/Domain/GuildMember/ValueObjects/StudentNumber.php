<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/17
 * Time: 15:31
 */

namespace App\Domain\GuildMember\ValueObjects;

use App\Domain\GuildMember\Spec\StudentNumberSpec;
use App\Exceptions\DomainException;
use PhpParser\Node\Scalar\String_;

class StudentNumber
{
    private $code;

    const MATCH = ['b','B'];
    const ENGLISH_LENGTH = 1;
    const DIGIT_LENGTH = 4;
    const MAX_LENGTH = self::ENGLISH_LENGTH + self::DIGIT_LENGTH;

    public function __construct(String $code)
    {

        if( !StudentNumberSpec::validateFormat($code) ) throw new DomainException("Error");

        $this->code = $code;
    }

    public function code(): String
    {
        return $this->code;
    }
}