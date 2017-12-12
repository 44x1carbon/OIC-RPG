<?php

namespace App\Http\Controllers;

use App\Domain\Guild\Service\GuildService;
use App\Domain\GuildMember\GuildMember;
use App\Domain\PartyWrittenRequest\Factory\PartyWrittenRequestFactory;
use App\Domain\ProductionIdea\Factory\ProductionIdeaFactory;
use App\Http\Requests\PartyCreateRequest;
use App\Presentation\PartyServiceFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartyController extends Controller
{
    public function store(
        PartyCreateRequest $request,
        PartyServiceFacade $partyServiceFacade,
        PartyWrittenRequestFactory $partyWrittenRequestFactory,
        GuildMember $loginMember
    )
    {
        $partyId = $partyServiceFacade->registerParty(
            $request->activityEndDate(),
            $loginMember->studentNumber()->code(),
            $request->roleName(),
            $request->productionTheme(),
            $request->productionTypeId(),
            $request->ideDescription(),
            $request->wantedRoleList()
        );

        return response($partyId);
    }
}
