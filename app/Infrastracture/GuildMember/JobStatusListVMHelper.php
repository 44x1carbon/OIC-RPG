<?php

namespace App\Infrastracture\GuildMember;

/**
 * Class JobStatusListVMHelper
 * @package App\Infrastracture\GuildMember
 */
class JobStatusListVMHelper
{
    /**
     * @param array $skillStatusList
     * @return array
     */
    public function groupByField(array $jobStatusList): array
    {
        return collect($jobStatusList)->groupBy(function(MemberJobStatusViewModel $statusViewModel) {
            return $statusViewModel->job()->field()->toKey();
        })->toArray();
    }
}