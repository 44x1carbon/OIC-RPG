<?php

use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Presentation\PartyParticipationRequestFacade;
use Tests\Sampler;

/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/01/05
 * Time: 17:57
 */

class ReplyPartyParticipationRequestTest extends \Tests\TestCase
{
    /* @var PartyParticipationRequestFacade $partyParticipationRequestFacade*/
    protected $partyParticipationRequestFacade;
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
    protected $partyParticipationRequestRepository;
    /* @var PartyRepositoryInterface $partyRepository */
    protected $partyRepository;

    protected $party;
    protected $guildMember;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->partyParticipationRequestFacade = app(PartyParticipationRequestFacade::class);
        $this->partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
        $this->partyRepository = app(PartyRepositoryInterface::class);
        $this->party = $this->sampleParty();
    }

    // パーティ参加申請に許可した場合のテスト
    public function testReplyPermitSuccess()
    {
        $this->party->addWantedFrame('1', 1);
        $this->partyRepository->save($this->party);
        $this->partyParticipationRequestFacade->sendPartyParticipationRequest($this->party->id(), "1", "B4999");

        $replyPartyParticipationRequestId = $this->partyParticipationRequestFacade->replyPartyParticipationRequest($this->party->id(), $this->party->partyManagerId()->code(), "B4999", "permit");
        $partyParticipationRequest = $this->partyParticipationRequestRepository->findById($replyPartyParticipationRequestId);

        $newParty = $this->partyRepository->findById($this->party->id());
        $newWantedRole = $newParty->wantedRoles()[0];
        $this->assertTrue($partyParticipationRequest->partyId() === $this->party->id());
        $this->assertTrue($partyParticipationRequest->guildMemberId()->code() === "B4999");
        $this->assertTrue($partyParticipationRequest->reply()->isPermit());

        // パーティにassignされているか確認
        $this->assertSame("B4999", $newWantedRole->wantedMemberList()->findById('2')->officerId()->code());
    }

    // パーティ参加申請に拒否した場合のテスト
    public function testReplyRejectionSuccess()
    {
        $this->party->addWantedFrame('1', 1);
        $this->partyRepository->save($this->party);
        $this->partyParticipationRequestFacade->sendPartyParticipationRequest($this->party->id(), "1", "B4999");

        $replyPartyParticipationRequestId = $this->partyParticipationRequestFacade->replyPartyParticipationRequest($this->party->id(), $this->party->partyManagerId()->code(), "B4999", "rejection");
        $partyParticipationRequest = $this->partyParticipationRequestRepository->findById($replyPartyParticipationRequestId);

        $newParty = $this->partyRepository->findById($this->party->id());
        $newWantedRole = $newParty->wantedRoles()[0];
        $this->assertTrue($partyParticipationRequest->partyId() === $this->party->id());
        $this->assertTrue($partyParticipationRequest->guildMemberId()->code() === "B4999");
        $this->assertTrue($partyParticipationRequest->reply()->isRejection());

        // パーティにassignされていないか確認
        $this->assertSame(null, $newWantedRole->wantedMemberList()->findById('2')->officerId());
    }

    /**
     * パーティ参加申請へ返信したのがPartyの管理者じゃなかった場合
     *
     * @expectedException Exception
     */
    public function testManagerIdFail()
    {
        $this->partyParticipationRequestFacade->sendPartyParticipationRequest($this->party->id(),"abcd", "B4999");

        $this->partyParticipationRequestFacade->replyPartyParticipationRequest($this->party->id(), "B5000","B4999","permit");
    }
}