<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2017/12/27
 * Time: 18:12
 */

namespace App\ApplicationService;


use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\PartyParticipationRequest;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Domain\PartyParticipationRequest\Spec\PartyParticipationRequestSpec;

class PartyParticipationRequestAppService
{
    /* @var PartyRepositoryInterface $partyRepository */
    protected $partyRepository;
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
    protected $partyParticipationRequestRepository;

    public function __construct(PartyRepositoryInterface $partyRepository, PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository)
    {
        $this->partyRepository = $partyRepository;
        $this->partyParticipationRequestRepository = $partyParticipationRequestRepository;
    }

    public function findManagementPartyParticipationRequestList(StudentNumber $partyManagerId)
    {
        $partyList = $this->partyRepository->findListByManagerId($partyManagerId);

        $partyParticipationRequestList = [];
        foreach ($partyList as $party){
            $partyParticipationRequestList = array_merge($partyParticipationRequestList, $this->partyParticipationRequestRepository->findListByPartyId($party->id()));
        }

        $noReplyPartyParticipationRequestList = array_filter($partyParticipationRequestList, function(PartyParticipationRequest $request) {
            return !PartyParticipationRequestSpec::alreadyReply($request);
        });
        return $noReplyPartyParticipationRequestList;
    }

    public function findStudentNumberPartyParticipationRequestList(StudentNumber $studentNumber)
    {
        return $this->partyParticipationRequestRepository->findListByStudentNumber($studentNumber);
    }

}