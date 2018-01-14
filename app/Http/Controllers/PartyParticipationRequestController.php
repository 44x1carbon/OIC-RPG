<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/01/12
 * Time: 18:52
 */

namespace App\Http\Controllers;


use App\Domain\GuildMember\GuildMember;
use App\Presentation\PartyParticipationRequestFacade;
use Illuminate\Http\Request;

class PartyParticipationRequestController
{
    public function store(
        string $partyId,
        string $wantedRoleId,
        PartyParticipationRequestFacade $partyParticipationRequestFacade,
        GuildMember $loginMember
    )
    {
        $partyParticipationRequestFacade->sendPartyParticipationRequest($partyId, $wantedRoleId, $loginMember->studentNumber()->code());
        return redirect()->route('show_party_detail', ['partyId' => $partyId]);
    }

    public function destroy(
        string $partyParticipationRequestId,
        PartyParticipationRequestFacade $partyParticipationRequestFacade,
        GuildMember $loginMember
    )
    {
        $partyParticipationRequestFacade->cancelPartyParticipationRequest($partyParticipationRequestId, $loginMember->studentNumber()->code());
        return back();
    }
}