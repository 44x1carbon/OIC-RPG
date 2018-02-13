<?php

namespace App\ApplicationService;

use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Scout\Scout;
use App\Domain\Scout\ScoutRepositoryInterface;

class ScoutAppService
{
    function __construct(
        PartyRepositoryInterface $partyRepository,
        ScoutRepositoryInterface $scoutRepository,
        GuildMemberRepositoryInterface $guildMemberRepository
    )
    {
        $this->partyRepository = $partyRepository;
        $this->scoutRepository = $scoutRepository;
        $this->guildMemberRepository = $guildMemberRepository;
    }

    public function sendScout(
        StudentNumber $from,
        StudentNumber $to,
        string $partyId,
        string $message
    )
    {
        if($this->guildMemberRepository->findByStudentNumber($from) == null) throw new \Exception("");
        if($this->guildMemberRepository->findByStudentNumber($to) == null) throw new \Exception("");

        $party = $this->partyRepository->findById($partyId);

        if(is_null($party)) throw new \Exception("");
        if(!$party->isPartyManagerId($from)) throw new \Exception("");

        $id = $this->scoutRepository->nextId();
        $scout = new Scout(
            $id,
            $from,
            $to,
            $partyId,
            $message,
            new \DateTime()
        );

        $this->scoutRepository->save($scout);
    }
}