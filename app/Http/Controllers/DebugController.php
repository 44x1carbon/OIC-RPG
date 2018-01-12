<?php

namespace App\Http\Controllers;

use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\PossessionSkillCollection;
use App\Infrastracture\GuildMember\GuildMemberViewModel;
use Illuminate\Http\Request;

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
            $possessionSkills[] = new PossessionSkill($loginMember->studentNumber(), $skillId, $level, PossessionSkill::LEVEL_UP_INTERVAL * $level);
        }

        $loginMember->setPossessionSkills(new PossessionSkillCollection($possessionSkills));

        $guildMemberRepository->save($loginMember);

        return redirect()->route('show_learn_skill');
    }
}