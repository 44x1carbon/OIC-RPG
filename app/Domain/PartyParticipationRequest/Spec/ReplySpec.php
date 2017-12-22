<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/20
 * Time: 11:15
 */

namespace App\Domain\PartyParticipationRequest\Spec;

use App\Domain\PartyParticipationRequest\ValueObjects\Reply;
use App\DomainUtility\SpecTrait;

class ReplySpec
{
    use SpecTrait;

    public static function isAvailable(String $type): bool
    {
        //受け取った値が利用可能か判定
        //Replyのリストと受け取り値を判定
        $list = Reply::STATUS_LIST;
        return in_array($type,$list);
    }
}