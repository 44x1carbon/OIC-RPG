<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/24
 * Time: 16:03
 */

namespace App\Domain\PossessionJob;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\ValueObjects\JobId;

class PossessionJob
{
    private $studentNumber;
    private $jobId;

    public function __construct(StudentNumber $studentNumber, JobId $jobId)
    {
        $this->studentNumber = $studentNumber;
        $this->jobId = $jobId;
    }

    public function studentNumber()
    {
        return $this->studentNumber;
    }

    public function jobId()
    {
        return $this->jobId;
    }
}