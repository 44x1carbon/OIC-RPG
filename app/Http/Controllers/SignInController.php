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
        $authData = SignInFacade::signIn($request->mailAddress(), $request->password());
        if ($authData){
            return redirect()->route('show_my_page');
        }
        // ログイン失敗
        return redirect()->back();
    }

}