<?php

namespace App\Infrastracture\GuildMember;

/**
 * Class SkillStatusListVMHelper
 * @package App\Infrastracture\GuildMember
 */
class SkillStatusListVMHelper
{
    /**
     * @param array $skillStatusList
     * @return array
     */
    public function groupByField(array $skillStatusList): array
    {
        return collect($skillStatusList)->groupBy(function(MemberSkillStatusViewModel $statusViewModel) {
            return $statusViewModel->field()->toKey();
        })->toArray();
    }

    /**
     * @param array $skillStatusList
     * @return array
     */
    public function sortLevel(array $skillStatusList): array
    {
        return collect($skillStatusList)
            ->filter(function(MemberSkillStatusViewModel $statusViewModel) {
                return $statusViewModel->skillAcquisitionStatus->isLearned();
            })
            ->sortByDesc(function(MemberSkillStatusViewModel $statusViewModel) {
                return $statusViewModel->possessionSkill->skillLevel;
            })
            ->toArray();
    }
}