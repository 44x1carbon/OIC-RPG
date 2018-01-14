<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/22
 * Time: 12:24
 */

namespace App\Infrastracture\PartyParticipationRequest;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\DomainUtility\RandomStringGenerator;
use App\Eloquents\PartyParticipationRequestEloquent;

class PartyParticipationRequestEloquentRepositoryImpl implements PartyParticipationRequestRepositoryInterface
{
    protected $eloquent;

    public function __construct(PartyParticipationRequestEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    public function findById(string $id): ?PartyParticipationRequest
    {
        return null_safety($this->eloquent->where('party_participation_request_id', $id)->first(), function(PartyParticipationRequestEloquent $model) {
            return $model->toEntity();
        });
    }

    /*
     * 渡したStudentNumberが申請しているパーティ参加申請の一覧を取得
     *
     * return PartyParticipationRequest[]
     */
    public function findListByStudentNumber(StudentNumber $studentNumber): array
    {
        return $this->eloquent->where('guild_member_id', $studentNumber->code())->get()->map(function(PartyParticipationRequestEloquent $model) {
             return $model->toEntity();
        })->toArray();
    }

    /*
     * 渡したPartyIdに対し申請されているパーティ参加申請の一覧を取得
     *
     * return PartyParticipationRequest[]
     */
    public function findListByPartyId(string $partyId): array
    {
        return $this->eloquent->where('party_id', $partyId)->get()->map(function(PartyParticipationRequestEloquent $model) {
            return $model->toEntity();
        })->toArray();
    }

    /**
     * 渡したPartyIdとwantedRoleIdを元にパーティ参加申請を取得
     *
     * @param string $partyId
     * @param string $wantedRoleId
     * @return PartyParticipationRequest|null
     */
    public function findByPartyIdAndWantedRoleId(string $partyId, string $wantedRoleId): ?PartyParticipationRequest
    {
        return null_safety($this->eloquent->where('party_id', $partyId)->where('wanted_role_id', $wantedRoleId)->first(), function(PartyParticipationRequestEloquent $model) {
            return $model->toEntity();
        });
    }

    /**
     * 渡したPartyIdとStudentNumberを元にParty参加申請を取得
     *
     * @param string $partyId
     * @param StudentNumber $studentNumber
     * @return PartyParticipationRequest|null
     */
    public function findByPartyIdAndStudentNumber(string $partyId, StudentNumber $studentNumber): ?PartyParticipationRequest
    {
        return null_safety($this->eloquent->where('party_id', $partyId)->where('guild_member_id', $studentNumber->code())->first(), function(PartyParticipationRequestEloquent $model) {
            return $model->toEntity();
        });
    }

    public function save(PartyParticipationRequest $party): bool
    {
        return PartyParticipationRequestEloquent::saveDomainObject($party);
    }

    public function all(): array
    {
        return $this->eloquent->all()->map(function(PartyParticipationRequestEloquent $model) {
            return $model->toEntity();
        })->toArray();
    }

    public function nextId(): string
    {
        do {
            $randId = RandomStringGenerator::makeLowerCase(4);
        } while ($this->eloquent->where('party_participation_request_id', $randId)->first());
        return $randId;
    }

    public function delete(PartyParticipationRequest $partyParticipationRequest): bool
    {
        $partyParticipationRequestModel = $this->eloquent->findById($partyParticipationRequest->id());
        if (!$partyParticipationRequestModel) return false;

        return $partyParticipationRequestModel->delete();
    }
}