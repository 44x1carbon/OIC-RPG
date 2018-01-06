<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/19
 * Time: 12:12
 */

namespace App\Domain\PartyParticipationRequest;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PartyParticipationRequest\ValueObjects\Reply;
use Carbon\Carbon;
use \Datetime;

/**
 * パーティ参加申請
 */
class PartyParticipationRequest
{
    protected $id;              // 参加申請ID
    protected $partyId;         // 参加したいパーティのID
    protected $wantedRoleId;    // 参加したいパーティ内の役割
    protected $guildMemberId;   // 参加したいギルドメンバーのID
    protected $applicationAt; // 申請日時
    protected $reply;           // 申請への返事VO

    public function __construct(
        string $id,
        string $partyId,
        string $wantedRoleId,
        StudentNumber $guildMemberId,
        DateTime $applicationAt = null,
        Reply $reply = null
    )
    {
        $this->id = $id;
        $this->partyId = $partyId;
        $this->wantedRoleId = $wantedRoleId;
        $this->guildMemberId = $guildMemberId;
        $this->applicationAt = $applicationAt ?? Carbon::now();
        $this->reply = $reply;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function partyId(): string
    {
        return $this->partyId;
    }

    /**
     * @return string
     */
    public function wantedRoleId(): string
    {
        return $this->wantedRoleId;
    }

    /**
     * @return StudentNumber
     */
    public function guildMemberId(): StudentNumber
    {
        return $this->guildMemberId;
    }

    /**
     * @return Datetime|static
     */
    public function applicationAt(): Datetime
    {
        return $this->applicationAt;
    }

    /**
     * @return Reply|null
     */
    public function reply(): ?Reply
    {
        return $this->reply;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $partyId
     */
    public function setPartyId(string $partyId)
    {
        $this->partyId = $partyId;
    }

    /**
     * @param string $wantedRoleId
     */
    public function setWantedRoleId(string $wantedRoleId)
    {
        $this->wantedRoleId = $wantedRoleId;
    }

    /**
     * @param StudentNumber $guildMemberId
     */
    public function setGuildMemberId(StudentNumber $guildMemberId)
    {
        $this->guildMemberId = $guildMemberId;
    }

    /**
     * @param Reply $Reply
     */
    public function returnReply(Reply $Reply)
    {
        $this->reply = $Reply;
    }

}