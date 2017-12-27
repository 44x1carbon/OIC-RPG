<?php

use App\ApplicationService\PartyAppService;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use Tests\Sampler;

/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/15
 * Time: 16:15
 */

class RegisterPartyParticipationRequestTest extends \Tests\TestCase
{
    use Sampler;

    /* @var PartyAppService $partyAppService*/
    protected $partyAppService;
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
    protected $registerPartyParticipationRequestRepository;

    protected $party;
    protected $guildMember;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->partyAppService = app(PartyAppService::class);
        $this->registerPartyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
    }

    public function testSuccess()
    {
        $partyParticipationRequestId = $this->partyAppService->registerPartyParticipationRequest("abcd","abcd", "B4999");

        $partyParticipationRequest = $this->registerPartyParticipationRequestRepository->findById($partyParticipationRequestId);

        $this->assertTrue($partyParticipationRequest->partyId() === "abcd");
        $this->assertTrue($partyParticipationRequest->wantedRoleId() === "abcd");
        $this->assertTrue($partyParticipationRequest->guildMemberId()->code() === "B4999");
    }
}