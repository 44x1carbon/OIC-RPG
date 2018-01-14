<?php

namespace App\Http\Controllers;

use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Infrastracture\AuthData\AuthData;
use App\Infrastracture\GuildMember\GuildMemberViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebugController extends Controller
{
    public function showLearnSkill(GuildMember $loginMember)
    {
        $guildMember = new GuildMemberViewModel($loginMember);
        return view('Debug.LearnSkill')
            ->with('guildMember', $guildMember);
    }

    public function doLearnSkill(
        Request $request,
        GuildMember $loginMember,
        GuildMemberRepositoryInterface $guildMemberRepository
    )
    {
        $possessionSkills = [];
        foreach ($request->get('update') as $skillId => $level) {
            if($level != 0) $possessionSkills[] = new PossessionSkill($loginMember->studentNumber(), $skillId, $level, PossessionSkill::LEVEL_UP_INTERVAL * $level);
        }

        $loginMember->setPossessionSkills(new PossessionSkillCollection($possessionSkills));

        $guildMemberRepository->save($loginMember);

        return redirect()->route('show_learn_skill');
    }

    public function showSignIn()
    {
           return view('Debug.SignIn')
               ->with('guildMembers', AuthData::all()->map(function(AuthData $model) { return $model->guildMemberEntity(); }) );
    }

    public function doSignIn(Request $request)
    {
        $address = $request->get('address');
        Auth::login(AuthData::where('email', $address)->first());
        return redirect()->route('show_my_page');
    }
}