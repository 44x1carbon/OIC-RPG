<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/08
 * Time: 11:23
 */

namespace App\Presentation;


use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\PassWord;
use App\Infrastracture\AuthData\AuthData;
use Illuminate\Support\Facades\Auth;

class SignInFacade
{
    public function __construct()
    {
    }

    public static function signIn(String $mailAddress, String $passWord): ?AuthData
    {
        $guildMemberRepository = app(GuildMemberRepositoryInterface::class);
        $loginInfo = new LoginInfo(new MailAddress($mailAddress), new PassWord($passWord));
        $guildMember = $guildMemberRepository->findByLoginInfo($loginInfo);

        if ($guildMember) {
            $authData = AuthData::findByLoginInfo($loginInfo);
            Auth::login($authData);
            return $authData;
        }
        return null;
    }

}