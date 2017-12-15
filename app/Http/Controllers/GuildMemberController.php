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
        GuildMember $loginMember
    )
    {
        if ($guildMemberRepository->delete($loginMember)) {
            return response($loginMember->studentName());
        }else{
            return back();
        }
    }
}