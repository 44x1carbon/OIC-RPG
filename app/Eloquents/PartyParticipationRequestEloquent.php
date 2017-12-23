<?php

namespace App\Eloquents;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Domain\PartyParticipationRequest\ValueObjects\Reply;
use Illuminate\Database\Eloquent\Model;
use \DateTime;

class PartyParticipationRequestEloquent extends Model
{
    protected $table = 'party_participation_requests';

    /**
     * ドメインオブジェクトを利用して永続化&親とのリレーションをはる
     */
    public static function saveDomainObject(PartyParticipationRequest $partyParticipationRequest): bool
    {
        $model = self::findOrNewModel($partyParticipationRequest);
        $model->setAttrByEntity($partyParticipationRequest);
        $result = $model->save();

        return $result;
    }

    /**
     * 引数で与えられたPartyのIdからEloquentを検索し、なければ新しく作る
     */
    public static function findOrNewModel(PartyParticipationRequest $partyParticipationRequest)
    {
        return self::where('party_participation_request_id', $partyParticipationRequest->id())->firstOrNew([]);
    }

    /**
     * ドメインオブジェクトからEloquentの属性をセットする
     */
    public function setAttrByEntity(PartyParticipationRequest $partyParticipationRequest): PartyParticipationRequestEloquent
    {
        $this->party_participation_request_id = $partyParticipationRequest->id();
        $this->party_id = $partyParticipationRequest->partyId();
        $this->wanted_role_id = $partyParticipationRequest->wantedRoleId();
        $this->guild_member_id = $partyParticipationRequest->guildMemberId()->code();
        $this->application_date = $partyParticipationRequest->applicationDate();
        $this->reply = null_safety($partyParticipationRequest->reply(), function(Reply $reply) {
            return $reply->status();
        });
        return $this;
    }


    public function toEntity(): PartyParticipationRequest
    {
        return new PartyParticipationRequest(
            $this->party_participation_request_id,
            $this->party_id,
            $this->wanted_role_id,
            new StudentNumber($this->guild_member_id),
            new DateTime($this->application_date),
            null_safety($this->reply, function($reply) {
                return new Reply($reply);
            })
        );
    }
}

