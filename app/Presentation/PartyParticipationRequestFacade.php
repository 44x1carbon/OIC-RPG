<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/19
 * Time: 15:00
 */

namespace App\Presentation;


use App\ApplicationService\PartyAppService;
use App\ApplicationService\PartyParticipationRequestAppService;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Domain\PartyParticipationRequest\ValueObjects\Reply;
use \DateTime;

class PartyParticipationRequestFacade
{
    /* @var PartyAppService $partyAppService */
    protected $partyAppService;
    /* @var PartyParticipationRequestAppService $partyParticipationRequestAppService */
    protected $partyParticipationRequestAppService;
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepo */
    protected $partyParticipationRequestRepo;

    public function __construct(PartyAppService $partyAppService, PartyParticipationRequestAppService $partyParticipationRequestAppService, PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepo)
    {
        $this->partyAppService = $partyAppService;
        $this->partyParticipationRequestAppService = $partyParticipationRequestAppService;
        $this->partyParticipationRequestRepo = $partyParticipationRequestRepo;
    }

    // パーティ参加申請を作成
    public function sendPartyParticipationRequest(
        string $partyId,
        string $wantedRoleId,
        string $guildMemberIdData
    )
    {
        return $this->partyAppService->sendPartyParticipationRequest($partyId, $wantedRoleId, new StudentNumber($guildMemberIdData));
    }

    // パーティ参加申請に返信
    public function replyPartyParticipationRequest(
        string $partyId,
        string $partyManagerId,
        string $guildMemberId,
        string $replyStatus
    )
    {
        $partyParticipationRequest = $this->partyParticipationRequestRepo->findByPartyIdAndStudentNumber($partyId, new StudentNumber($guildMemberId));
        return $this->partyAppService->replyPartyParticipationRequest($partyParticipationRequest->id(), new StudentNumber($partyManagerId), new Reply($replyStatus));
    }

    // 自分が管理しているパーティの参加申請一覧を取得
    public function findManagementPartyParticipationRequestList(string $managementId)
    {
        return $this->partyParticipationRequestAppService->findManagementPartyParticipationRequestList(new StudentNumber($managementId));
    }

    // 自分が申請しているパーティ参加申請一覧を取得
    public function findStudentNumberPartyParticipationRequestList(string $guildMemberId)
    {
        return $this->partyParticipationRequestAppService->findStudentNumberPartyParticipationRequestList(new StudentNumber($guildMemberId));
    }

}