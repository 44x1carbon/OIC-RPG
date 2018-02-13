<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/09
 * Time: 18:02
 */

namespace App\Domain\Notification\ValueObjects;

use App\Domain\Notification\Spec\NotificationTypeSpec;

class NotificationType
{
    const RECEIVE_PARTY_PARTICIPATION_REQUEST = 'receivePartyParticipationRequest';
    const REPLY_PARTY_PARTICIPATION_REQUEST = 'replyPartyParticipationRequest';

    const TYPE_LIST = [self::RECEIVE_PARTY_PARTICIPATION_REQUEST, self::REPLY_PARTY_PARTICIPATION_REQUEST];

    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
        if( !NotificationTypeSpec::isAvailable($type) ) throw new \Exception("Error");
    }

    public function type(): string
    {
        return $this->type;
    }

    // 自分の管理パーティに対する参加申請タイプを作成
    public static function RECEIVE_PARTY_PARTICIPATION_REQUEST(): NotificationType
    {
        return new NotificationType(self::RECEIVE_PARTY_PARTICIPATION_REQUEST);
    }

    // 自分の送った参加申請への返信タイプを作成
    public static function REPLY_PARTY_PARTICIPATION_REQUEST(): NotificationType
    {
        return new NotificationType(self::REPLY_PARTY_PARTICIPATION_REQUEST);
    }

    // リンクのタイプを判定
    public function is(string $type): bool
    {
        return $this->type === $type;
    }
}