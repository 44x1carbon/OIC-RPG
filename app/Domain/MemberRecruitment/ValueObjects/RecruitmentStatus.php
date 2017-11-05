<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/10/27
 * Time: 14:49
 */

namespace App\Domain\MemberRecruitment\ValueObjects;


use App\Domain\MemberRecruitment\Spec\RecruitmentStatusSpec;
use App\Exceptions\DomainException;

class RecruitmentStatus
{
    const OPEN = 'open';
    const CLOSE = 'close';
    const STATUS_LIST = [self::OPEN, self::CLOSE];

    private $status;

    public function __construct(String $status)
    {
        $this->status = $status;
        if( !RecruitmentStatusSpec::isAvailable($this->status) ) throw new DomainException("Error");
    }

    public function status()
    {
        return $this->status;
    }

}