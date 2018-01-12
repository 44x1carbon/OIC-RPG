<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/19
 * Time: 19:21
 */

namespace App\Domain\PartyParticipationRequest\ValueObjects;

use App\Domain\PartyParticipationRequest\Spec\ReplySpec;

class Reply
{
    // 申請ステータスを定数として定義

    const PERMIT = 'permit';
    const REJECTION = 'rejection';
    const STATUS_LIST = [self::PERMIT, self::REJECTION];

    private $status;

    public function __construct(string $status)
    {
        $this->status = $status;
        if ( !ReplySpec::isAvailable($status) ) throw new \Exception("Error");
    }

    public function status(): string
    {
        return $this->status;
    }

    // パーティ参加申請を許可しているか
    public function isPermit(): bool
    {
        return $this->status === self::PERMIT;
    }

    // パーティ参加申請を拒否しているか
    public function isRejection(): bool
    {
        return $this->status === self::REJECTION;
    }

}