<?php

namespace App\Http\Controllers;

use App\ApplicationService\ScoutAppService;
use App\Domain\GuildMember\GuildMember;
use App\Http\Requests\SendScoutRequest;

class ScoutController extends Controller
{
    public function send(
        GuildMember $loginMember,
        SendScoutRequest $request,
        ScoutAppService $scoutAppService
    )
    {
        $scoutAppService->sendScout(
            $loginMember->studentNumber(),
            $request->to(),
            $request->partyId(),
            $request->message()
        );

        return redirect($request->redirectTo());
    }
}