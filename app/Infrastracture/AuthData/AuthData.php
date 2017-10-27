<?php

namespace App\Infrastracture\AuthData;

use App\Domain\GuildMember\ValueObjects\LoginInfo;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class AuthData extends \App\User
{
    protected $table = 'users';

    public static function findByLoginInfo(LoginInfo $info): AuthData
    {
        $user = self::where([
            'email' => $info->address()->address()
        ])->firstOrFail();
        if(!Hash::check($info->password()->password(), $user->password)) throw new NotFoundResourceException();
        return $user;
    }
}