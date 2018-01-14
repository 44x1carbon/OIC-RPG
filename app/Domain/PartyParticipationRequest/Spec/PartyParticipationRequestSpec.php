<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/20
 * Time: 11:15
 */

namespace App\Domain\PartyParticipationRequest\Spec;

use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\DomainUtility\SpecTrait;

class PartyParticipationRequestSpec
{
    use SpecTrait;

    public static function alreadyReply(PartyParticipationRequest $request): bool
    {
        return !is_null($request->reply());
    }
}