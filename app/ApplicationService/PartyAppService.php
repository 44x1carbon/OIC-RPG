<?php

namespace App\ApplicationService;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Party\Spec\PartySpec;
use App\Domain\Party\ValueObjects\ActivityEndDate;

class PartyAppService
{
    protected $partyRepository;

    function __construct(PartyRepositoryInterface $partyRepository)
    {
        $this->partyRepository = $partyRepository;
    }

    public function registerParty(ActivityEndDate $activityEndDate, StudentNumber $managerId): string
    {
        $partyId = $this->partyRepository->nextId();
        $party = new Party($partyId, $activityEndDate, $managerId);

        $this->partyRepository->save($party);

        return $party->id();
    }

    public function updateProductionIdea(string $partyId, string $productionTheme = null, string $productionTypeId = null, string $ideaDescription = null)
    {
        $party = $this->partyRepository->findById($partyId);
        $party->editProductionIdea($productionTheme, $productionTypeId, $ideaDescription);

        $this->partyRepository->save($party);

        return $party->id();
    }

    public function addWantedRole(string $partyId, string $roleName, string $jobId = null, string $remarks = null, int $frameAmount): string
    {
        $party = $this->partyRepository->findById($partyId);
        $wantedRoleId = $party->addWantedRole($roleName, $jobId, $remarks);
        $party->addWantedFrame($wantedRoleId, $frameAmount);

        $this->partyRepository->save($party);

        return $wantedRoleId;
    }

    public function searchParty(string $keyword): array
    {
        $allParty = $this->partyRepository->all();
        $releasedParty = array_filter($allParty, function(Party $party) {
            //return $party->released();
            return true;
        });
        $matchedParty = array_filter($releasedParty, function(Party $party) use($keyword){
            return PartySpec::isKeywordMatch($party, $keyword);
        });

        return array_values($matchedParty);
    }
}