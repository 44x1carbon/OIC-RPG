<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/17
 * Time: 15:58
 */

namespace App\Http\Controllers;


use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Http\Requests\GuildMemberRequest;
use App\Http\Requests\MyPageRequest;
use App\Http\ViewComposers\FieldViewModelComposer;
use App\Infrastracture\GuildMember\GuildMemberViewModel;

class GuildMemberController extends Controller
{

    public function update(
        GuildMemberRequest $request,
        GuildMemberRepositoryInterface $guildMemberRepository,
        GuildMember $loginMember
    )
    {
        $updateMember = $loginMember;
        $updateMember->setStudentName($request->studentName());
        $updateMember->setGender($request->gender());
        $updateMember->setCourse($request->course());

        if ($guildMemberRepository->save($updateMember)) {
            return response($updateMember->studentNumber()->code());
        }else{
            return response($updateMember->studentNumber()->code(),304);
        }
    }

    public function destroy(
        GuildMemberRepositoryInterface $guildMemberRepository,
        GuildMember $loginMember = null
    )
    {
        if ($loginMember && $guildMemberRepository->delete($loginMember)) {
            return response($loginMember->studentName());
        }else{
            return back();
        }
    }

    public function myPage(MyPageRequest $request, GuildMember $loginMember)
    {
        $guildMember = new GuildMemberViewModel($loginMember);
        $guildMember->skillStatusList();
        $viewFactory = view();
        $viewFactory->composer('*', FieldViewModelComposer::class);

        return $viewFactory->make('Status.MyPage')
            ->with('guildMember', $guildMember)
            ->with('selectSkillTab', $request->selectSkillTab())
            ->with('selectJobTab', $request->selectJobTab());
    }
}