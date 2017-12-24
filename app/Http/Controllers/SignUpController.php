<?php

namespace App\Http\Controllers;

use App\ApplicationService\GuildMemberAppService;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Http\Requests\SignUpRequest;
use App\Infrastracture\AuthData\AuthData;
use App\Presentation\GuildMemberFacade;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller
{
    public function create()
    {

    }

    public function store(SignUpRequest $request, GuildMemberFacade $guildMemberFacade)
    {
        $authData = $guildMemberFacade->registerMember(
            $request->studentNumber(),
            $request->studentName(),
            $request->courseId(),
            $request->genderId(),
            $request->mailAddress(),
            $request->password()
        );
        Auth::login($authData);
    }
}