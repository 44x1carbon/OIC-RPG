<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/02
 * Time: 18:23
 */

namespace Tests\Application\Notification;

use App\ApplicationService\NotificationAppService;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Presentation\PartyParticipationRequestFacade;
use Tests\SampleGuildMember;
use Tests\TestCase;

class NotificationAppServiceTest extends TestCase
{
    /* @var NotificationRepositoryInterface $notificationRepo */
    private $notificationRepo;
    /* @var NotificationAppService $notificationAppService */
    private $notificationAppService;
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
    private $partyParticipationRequestRepository;
    /* @var PartyParticipationRequestFacade $partyParticipationRequestFacade */
    private $partyParticipationRequestFacade;
    /* @var PartyParticipationRequest $partyParticipationRequest */
    private $partyParticipationRequest;
    private $partyRepository;
    private $party;
    private $guildMember;
    private $partyParticipationRequestId;

    public function setUp()
    {
        parent::setUp();

        $this->notificationRepo = app(NotificationRepositoryInterface::class);
        $this->notificationAppService = app(NotificationAppService::class);
        $this->partyParticipationRequestFacade = app(PartyParticipationRequestFacade::class);
        $this->partyRepository = app(PartyRepositoryInterface::class);
        $this->partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
        $this->guildMember = $this->sampleGuildMember([SampleGuildMember::studentNumber => new StudentNumber("B4991")]);
        $this->party = $this->sampleParty(['partyManagerId' => "B4000"]);
        $this->party->addWantedFrame('1', 1);
        $this->partyRepository->save($this->party);
        $this->partyParticipationRequestId = $this->partyParticipationRequestFacade->sendPartyParticipationRequest($this->party->id(),"1", $this->guildMember->studentNumber()->code());
        $this->partyParticipationRequest = $this->partyParticipationRequestRepository->findById($this->partyParticipationRequestId);
    }

    public function testSendPartyParticipationRequestReception()
    {
        $notificationId = $this->notificationAppService->sendPartyParticipationRequestReception($this->partyParticipationRequestId);
        $notification = $this->notificationRepo->findById($notificationId);

        $this->assertTrue($notification->toStudentNumber()->equals(new StudentNumber("B4000")));
        $this->assertSame(route('show_party_detail', ['partyId' => $this->partyParticipationRequest->partyId()]),$notification->link()->partyUrl());

        // 既読のテスト
        $notification->reading();
        $this->notificationRepo->save($notification);
        $replyNotification = $this->notificationRepo->findById($notification->id());
        $this->assertTrue($replyNotification->isRead());
    }

    public function testSendPartyParticipationRequestReply()
    {
        $replyPartyParticipationRequestId = $this->partyParticipationRequestFacade->replyPartyParticipationRequest($this->partyParticipationRequestId, $this->party->partyManagerId()->code(), "permit");
        $notificationId = $this->notificationAppService->sendPartyParticipationRequestReply($replyPartyParticipationRequestId);

        $notification = $this->notificationRepo->findById($notificationId);
        $this->assertTrue($notification->toStudentNumber()->equals(new StudentNumber("B4991")));
        $this->assertSame(route('show_party_detail', ['partyId' => $this->partyParticipationRequest->partyId()]),$notification->link()->partyUrl());

        // 既読のテスト
        $notification->reading();
        $this->notificationRepo->save($notification);
        $replyNotification = $this->notificationRepo->findById($notification->id());
        $this->assertTrue($replyNotification->isRead());
    }

}