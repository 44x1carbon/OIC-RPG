<?php

namespace App\Presentation;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PartyWrittenRequest\ValueObject\ProductionIdeaInfo;

Interface GuildReceptionistFacadeInterface
{

    /**
     *
     * @return PartyId
     */
    public function PartyWrittenRequestAcceptance(StudentNumber $applicantId, \DateTime $activityEndDate, ProductionIdeaInfo $productionIdeaInfo, WantedRoleInfoList $wantedRoleInfoList): PartyId;
}