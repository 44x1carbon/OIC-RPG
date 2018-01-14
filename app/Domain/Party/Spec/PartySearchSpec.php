<?php

namespace App\Domain\Party\Spec;

use App\Domain\GetCondition\GetCondition;
use App\Domain\Job\Job;
use App\Domain\Party\Party;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\WantedRole\WantedRole;

class PartySearchSpec
{
    public static function isKeywordMatch(Party $party, string $keyword): bool
    {
        if($keyword == '') return true;
        return is_any([
            self::isIncludeKeywordInTheme($party, $keyword),
            self::isSomeProductionType($party, $keyword),
            self::isIncludeKeyWordInWanted($party, $keyword),
        ]);
    }

    public static function isIncludeKeywordInTheme(Party $party, string $keyword): bool
    {
        return strpos($party->productionIdea()->productionTheme(), $keyword) !== false;
    }

    public static function isIncludeKeyWordInWanted(Party $party, string $keyword): bool
    {
        return is_any($party->wantedRoles(), function(WantedRole $wantedRole) use ($keyword) {
           return is_any([
               self::isIncludeKeyWordWantedRoleName($wantedRole, $keyword),
               self::isIncludeKeyWordWantedRoleRemarks($wantedRole, $keyword),
               self::isSomeReferenceJobName($wantedRole, $keyword),
               self::isSomeGetConditionSkillName($wantedRole->referenceJob(), $keyword)
           ]);
        });
    }

    public static function isSomeProductionType(Party $party, string $keyword): bool
    {
        $productionType = $party->productionIdea()->productionType();
        return $productionType->name() == $keyword;
    }

    public static function isIncludeKeyWordWantedRoleName(WantedRole $wantedRole, string $keyword): bool
    {
        return self::isInclude($wantedRole->roleName(), $keyword);
    }

    public static function isSomeReferenceJobName(WantedRole $wantedRole, string $keyword): bool
    {
        $referenceJob = $wantedRole->referenceJob();
        return $referenceJob->jobName() === $keyword;
    }

    public static function isSomeGetConditionSkillName(Job $job, string $keyword): bool
    {
        $skillRepo = app(SkillRepositoryInterface::class);

        return is_any($job->getConditions(), function(GetCondition $getCondition) use($skillRepo, $keyword) {
            $skill = $skillRepo->findBySkillId($getCondition->skillId());
            if(is_null($skill)) return false;
            return $skill->skillName() == $keyword;
        });
    }

    public static function isIncludeKeyWordWantedRoleRemarks(WantedRole $wantedRole, string $keyword): bool
    {
        return self::isInclude($wantedRole->remarks(), $keyword);
    }

    private static function isInclude(string $target, string $word): bool
    {
        return strpos($target, $word) !== false;
    }
}
