<?php

namespace App\Domain\GuildMember\Spec;

use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Job\Job;
use App\Domain\Job\ValueObjects\JobId;
use App\Domain\Skill\Skill;
use App\DomainUtility\SpecTrait;

class SearchSpec
{
    use SpecTrait;

    public static function isHigherLevel(GuildMember $guildMember, string $skillId, int $requireLevel): bool
    {
        $possessionSkill = $guildMember->possessionSkills()->findPossessionSkill($skillId);
        if(is_null($possessionSkill)) return false;
        return $possessionSkill->skillLevel() >= $requireLevel;
    }

    public static function ableToJob(GuildMember $guildMember, JobId $jobId): bool
    {
        $possessionJob = $guildMember->possessionJobs()->findPossessionJob($jobId);
        return !is_null($possessionJob);
    }

    public static function isMatchStudentNumber(GuildMember $guildMember, StudentNumber $studentNumber): bool
    {
        return $guildMember->studentName() == $studentNumber;
    }
}