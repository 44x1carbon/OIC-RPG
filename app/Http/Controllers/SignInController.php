<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/11/28
 * Time: 11:35
 */

namespace App\Http\Controllers;


use App\Http\Requests\SignInRequest;
use App\Infrastracture\AuthData\AuthData;
use App\Presentation\SignInFacade;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function store(SignInRequest $request)
    {
        $loginInfo = SignInFacade::signIn($request->mailAddress(), $request->password());
        if ($loginInfo){
            $authData = AuthData::findByLoginInfo($loginInfo);
            Auth::login($authData);
            // ログインに成功したGuildMemberのStudentNumberを返す
            return response($authData->guildMemberEntity()->studentNumber()->code());

        }
        // ログイン失敗
        return response(null, 401);
    }

}