<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/01/30
 * Time: 17:42
 */

namespace App\Domain\Notification\ValueObjects;

use App\Domain\Notification\Spec\LinkTypeSpec;

class LinkType
{
    const PARTY_PARTICIPATION_REQUEST = 'partyParticipationRequest';
    const PARTY  = 'party';

    const TYPE_LIST = [self::PARTY_PARTICIPATION_REQUEST, self::PARTY];

    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
        if( !LinkTypeSpec::isAvailable($type) ) throw new \Exception("Error");
    }

    public function type(): string
    {
        return $this->type;
    }

    // 参加申請のリンクタイプを作成
    public static function PARTY_PARTICIPATION_REQUEST(): LinkType
    {
        return new LinkType(self::PARTY_PARTICIPATION_REQUEST);
    }

    // パーティのリンクタイプを作成
    public static function PARTY(): LinkType
    {
        return new LinkType(self::PARTY);
    }

    // リンクタイプが参加申請かどうか
    public function isPartyParticipationRequest(): bool
    {
        return $this->type === self::PARTY_PARTICIPATION_REQUEST;
    }

    // リンクのタイプを判定
    public function is(string $type): bool
    {
        return $this->type === $type;
    }
}