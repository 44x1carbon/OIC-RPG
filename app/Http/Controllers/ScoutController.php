<?php

namespace App\Http\Controllers;

use App\ApplicationService\ScoutAppService;
use App\Domain\GuildMember\GuildMember;
use App\Http\Requests\SendScoutRequest;
use App\Infrastracture\Scout\ScoutFacade;

class ScoutController extends Controller
{
    public function send(
        GuildMember $loginMember,
        SendScoutRequest $request,
        ScoutFacade $facade
    )
    {
        $facade->sendScout(
            $loginMember->studentNumber()->code(),
            $request->to(),
            $request->partyId(),
            $request->message()
        );

        return redirect($request->redirectTo());
    }
}