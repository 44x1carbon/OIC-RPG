<?php

namespace App\Domain\GuildMember\ValueObjects;

use App\Domain\Job\ValueObjects\JobId;


/**
 * Class SearchCriteria
 * 検索条件を構築するクラス
 * @package App\Domain\GuildMember\ValueObjects
 */
class SearchCriteria
{


    function __construct()
    {
        $this->requestSkills = [];
        $this->requestJobIds = [];
        $this->requestStudentNumbers = [];
    }

    public function addRequestSkill(string $skillId, int $requireLevel): SearchCriteria
    {
        $this->requestSkills[] = new class($skillId, $requireLevel) {
            function __construct(string $skillId, int $requireLevel)
            {
                $this->skillId = $skillId;
                $this->requireLevel = $requireLevel;
            }
        };
        return $this;
    }

    public function addRequestJobId(JobId $jobId): SearchCriteria
    {
        $this->requestJobIds[] = $jobId;
        return $this;
    }

    public function addRequestStudentNumber(StudentNumber $studentNumber): SearchCriteria
    {
        $this->requestStudentNumbers[] = $studentNumber;
        return $this;
    }
}