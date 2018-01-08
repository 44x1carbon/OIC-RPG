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
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;

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
            $partyParticipationRequestList[$party->id()] = $this->partyParticipationRequestRepository->findListByPartyId($party->id());
        }
        return $partyParticipationRequestList;
    }

    public function findStudentNumberPartyParticipationRequestList(StudentNumber $studentNumber)
    {
        return $this->partyParticipationRequestRepository->findListByStudentNumber($studentNumber);
    }

}