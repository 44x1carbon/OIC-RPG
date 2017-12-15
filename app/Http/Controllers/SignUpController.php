<?php

namespace App\Http\Controllers;

use App\ApplicationService\GuildMemberAppService;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Http\Requests\SignUpRequest;
use App\Infrastracture\AuthData\AuthData;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller
{
    public function create()
    {

    }

    public function store(SignUpRequest $request, GuildMemberAppService $guildMemberAppService)
    {
        $authData = $guildMemberAppService->registerMember(
            $request->studentNumber(),
            $request->studentName(),
            $request->course(),
            $request->gender(),
            $request->mailAddress(),
            $request->loginInfo()
        );
        Auth::login($authData);
    }
}