<?php

namespace App\Http\Controllers;

use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Http\Requests\SignUpRequest;

class SignUpController extends Controller
{
    public function create()
    {

    }

    public function store(SignUpRequest $request, GuildMemberFactory $factory, GuildMemberRepositoryInterface $repository)
    {
        $guildMember = $factory->createGuildMember(
            $request->studentNumber(),
            $request->studentName(),
            $request->course(),
            $request->gender(),
            $request->mailAddress()
        );

        if($repository->save($guildMember)) {
            //ユーザー登録に成功
        } else {
            //ユーザー登録に失敗
        }

    }
}