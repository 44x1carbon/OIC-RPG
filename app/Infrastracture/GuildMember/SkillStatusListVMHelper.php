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
}