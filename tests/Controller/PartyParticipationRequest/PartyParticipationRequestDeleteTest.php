<?php

use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\PassWord;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Infrastracture\AuthData\AuthData;
use App\Presentation\PartyParticipationRequestFacade;

/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/01/14
 * Time: 15:46
 */

class PartyParticipationRequestDeleteTest extends \Tests\TestCase
{
    /* @var PartyRepositoryInterface $partyRepo */
    protected $partyRepo;
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepo */
    protected $partyParticipationRequestRepo;
    /* @var PartyParticipationRequestFacade $partyParticipationRequestFacade */
    protected $partyParticipationRequestFacade;
    protected $party;
    protected $guildMember;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->partyRepo = app(PartyRepositoryInterface::class);
        $this->partyParticipationRequestRepo = app(PartyParticipationRequestRepositoryInterface::class);
        $this->partyParticipationRequestFacade = app(PartyParticipationRequestFacade::class);
        $this->party = $this->sampleParty();
        $this->guildMember = $this->sampleGuildMember(['password' => new Password('abcd1234')]);
        $authData = AuthData::findByLoginInfo(new LoginInfo($this->guildMember->mailAddress(), new PassWord("abcd1234")));
        $this->actingAs($authData);
    }

    public function testSuccess()
    {
        $this->party->addWantedFrame($this->party->wantedRoles()[0]->id(), 1);
        $this->partyRepo->save($this->party);
        $partyParticipationRequestId = $this->partyParticipationRequestFacade->sendPartyParticipationRequest($this->party->id(), $this->party->wantedRoles()[0]->id(), $this->guildMember->studentNumber()->code());

        $response = $this->delete(route('destroy_party_participation_request', ['partyParticipationRequestId' => $partyParticipationRequestId]));
        $response->assertStatus(302);

        $partyParticipationRequest = $this->partyParticipationRequestRepo->findByPartyIdAndWantedRoleId($this->party->id(), $this->party->wantedRoles()[0]->id());

        $this->assertTrue(is_null($partyParticipationRequest));
    }
}