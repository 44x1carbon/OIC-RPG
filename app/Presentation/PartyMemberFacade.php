<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/15
 * Time: 15:31
 */

namespace App\Presentation;

use App\ApplicationService\PartyMemberAppService;
use App\Domain\GuildMember\ValueObjects\StudentNumber;

class PartyMemberFacade
{
    /* @var PartyMemberAppService $partyMemberAppService */
    protected $partyMemberAppService;

    public function __construct(PartyMemberAppService $partyMemberAppService)
    {
        $this->partyMemberAppService = $partyMemberAppService;
    }

    public function assignPartyMember(string $partyParticipationRequestId , string $partyManagerId)
    {
        $resultPartyMemberId = $this->partyMemberAppService->assignPartyMember($partyParticipationRequestId, new StudentNumber($partyManagerId));
        return $resultPartyMemberId;
    }
}