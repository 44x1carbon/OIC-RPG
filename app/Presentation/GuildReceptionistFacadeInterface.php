<?php

namespace App\Presentation;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PartyWrittenRequest\ValueObject\ProductionIdeaInfo;

Interface GuildReceptionistFacadeInterface
{

    /** パーティー新規作成の申請を聞き、パーティーを作成する*/
    public function PartyWrittenRequestAcceptance(StudentNumber $applicantId, \DateTime $activityEndDate, ProductionIdeaInfo $productionIdeaInfo, WantedRoleInfoList $wantedRoleInfoList): PartyId;
}