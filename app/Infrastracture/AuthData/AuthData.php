<?php

namespace App\Infrastracture\AuthData;

use App\Domain\GuildMember\GuildMember;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class AuthData extends \App\User
{
    protected $table = 'users';
    /* @var GuildMemberRepositoryInterface $guildMemberRepository */
    protected $guildMemberRepository;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->guildMemberRepository = app(GuildMemberRepositoryInterface::class);
    }

    public static function findByLoginInfo(LoginInfo $info): AuthData
    {
        $user = self::where([
            'email' => $info->address()->address()
        ])->firstOrFail();
        if(!Hash::check($info->password()->password(), $user->password)) throw new NotFoundResourceException();
        return $user;
    }

    public static function registerMember(LoginInfo $loginInfo): AuthData
    {
        return self::create([
            'email' => $loginInfo->address()->address(),
            'password' => Hash::make($loginInfo->password()->password())
        ]);
    }

    public function mailAddress(): MailAddress
    {
        return new MailAddress($this->email);
    }

    public function guildMemberEntity(): GuildMember
    {
        return $this->guildMemberRepository->findByMailAddress($this->mailAddress());
    }
}