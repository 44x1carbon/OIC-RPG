<?php

namespace App\Http\Controllers;

use App\Domain\GuildMember\GuildMember;
use App\Http\Requests\PartyCreateRequest;
use App\Presentation\PartyServiceFacade;

class PartyController extends Controller
{
    public function store(
        PartyCreateRequest $request,
        PartyServiceFacade $partyServiceFacade,
        GuildMember $loginMember
    )
    {
        $partyId = $partyServiceFacade->registerParty(
            $loginMember->studentNumber()->code(),
            $request->partyDto()
        );

        return response($partyId);
    }
}
