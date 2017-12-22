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

    public function __construct(string $type)
    {
        $this->type = $type;
        if ( !ReplySpec::isAvailable($type) ) throw new \Exception("Error");
    }

    public function type(): string
    {
        return $this->type;
    }

}