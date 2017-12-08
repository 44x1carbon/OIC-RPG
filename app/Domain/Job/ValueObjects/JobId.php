<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/08
 * Time: 11:46
 */

namespace App\Domain\Job\ValueObjects;


use App\Domain\Job\Spec\JobIdSpec;
use App\Exceptions\DomainException;

class JobId
{
    private $code;

    public function __construct(string $code)
    {
        if(!JobIdSpec::isExistCode($code)) throw new DomainException("Error");
        $this->code = $code;
    }

    public function code()
    {
        return $this->code;
    }
}