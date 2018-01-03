<?php

namespace App\Infrastracture\Party;

use App\Domain\Party\Party;
use App\Domain\Party\ValueObjects\PartyMemberInfo;
use App\Domain\WantedRole\WantedRole;
use App\Infrastracture\ProductionIdea\ProductionIdeaViewModel;
use App\Infrastracture\WantedRole\WantedRoleViewModel;

class PartyViewModel
{
    private $party;
    private $wantedRoles = null;
    private $productionIdea = null;
    private $partyMemberInfos = null;

    /**
     * PartyViewModel constructor.
     * @param Party $party
     */
    public function __construct(Party $party)
    {
        $this->party = $party;
        $this->id = $party->id();
        $this->activityEndDate = $this->party->activityEndDate()->date();
    }

    /**
     * @return array
     */
    public function wantedRoles(): array
    {
        if(is_null($this->wantedRoles)) {
            $this->wantedRoles = array_map(function(WantedRole $wantedRole) {
                return new WantedRoleViewModel($wantedRole);
            }, $this->party->wantedRoles());
        }
        return $this->wantedRoles;
    }

    /**
     * @return ProductionIdeaViewModel
     */
    public function productionIdea(): ProductionIdeaViewModel
    {
        if(is_null($this->productionIdea)) {
            $this->productionIdea = new ProductionIdeaViewModel($this->party->productionIdea());
        }
        return $this->productionIdea;
    }

    /**
     * @return array
     */
    public function partyMemberInfos(): array
    {
        if(is_null($this->partyMemberInfos)) {
            $this->partyMemberInfos = array_map(function(PartyMemberInfo $partyMemberInfo) {
                return new PartyMemberInfoViewModel($partyMemberInfo);
            }, $this->party->partyMembers());
        }

        return $this->partyMemberInfos;
    }
}
