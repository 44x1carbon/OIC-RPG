<?php

namespace App\Http\Controllers;

use App\Domain\Guild\Service\GuildService;
use App\Domain\GuildMember\GuildMember;
use App\Domain\PartyWrittenRequest\Factory\PartyWrittenRequestFactory;
use App\Domain\ProductionIdea\Factory\ProductionIdeaFactory;
use App\Http\Requests\PartyCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartyController extends Controller
{
    public function store(
        PartyCreateRequest $request,
        GuildService $guildService,
        PartyWrittenRequestFactory $partyWrittenRequestFactory,
        GuildMember $loginMember
    )
    {
        $partyWrittenRequest = $partyWrittenRequestFactory->createPartyWrittenRequest(
            $loginMember->studentNumber(),
            $request->activityEndDate(),
            $request->productionIdeaInfo(),
            $request->wantedRoleList()
        );
        $party = $guildService->partyRegister($partyWrittenRequest);
        return response($party);
    }
}
