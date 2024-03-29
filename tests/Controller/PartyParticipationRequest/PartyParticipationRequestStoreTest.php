<?php

use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\PassWord;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Infrastracture\AuthData\AuthData;

/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/01/14
 * Time: 11:34
 */

/**
 * パーティの募集役割に対して参加申請を作成するテスト
 */
class PartyParticipationRequestStoreTest extends \Tests\TestCase
{
    /* @var PartyRepositoryInterface $partyRepo */
    protected $partyRepo;
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepo */
    protected $partyParticipationRequestRepo;
    protected $party;
    protected $guildMember;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->partyRepo = app(PartyRepositoryInterface::class);
        $this->partyParticipationRequestRepo = app(PartyParticipationRequestRepositoryInterface::class);
        $this->party = $this->sampleParty();
        $this->guildMember = $this->sampleGuildMember(['password' => new Password('abcd1234')]);
        $authData = AuthData::findByLoginInfo(new LoginInfo($this->guildMember->mailAddress(), new PassWord("abcd1234")));
        $this->actingAs($authData);
    }

    public function testSuccess()
    {
        $this->party->addWantedFrame($this->party->wantedRoles()[0]->id(),1);
        $this->partyRepo->save($this->party);

        $response = $this->post(route('store_party_participation_request', ['partyId' => $this->party->id(), 'wantedRoleId' => $this->party->wantedRoles()[0]->id()]));
        $response->assertStatus(302);

        $partyParticipationRequest = $this->partyParticipationRequestRepo->findByPartyIdAndWantedRoleId($this->party->id(), $this->party->wantedRoles()[0]->id());

        $this->assertTrue($partyParticipationRequest->partyId() === $this->party->id());
        $this->assertTrue($partyParticipationRequest->wantedRoleId() === '1');
        $this->assertTrue($partyParticipationRequest->guildMemberId()->equals($this->guildMember->studentNumber()));
        $this->assertTrue(is_null($partyParticipationRequest->reply()));
    }
}