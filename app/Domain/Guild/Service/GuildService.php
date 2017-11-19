<?php

namespace App\Domain\Guild\Service;

use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\Party\Factory\PartyFactory;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyWrittenRequest\PartyWrittenRequest;
use App\Domain\ProductionIdea\Factory\ProductionIdeaFactory;
use App\Domain\WantedMember\Factory\WantedMemberFactory;
use App\Domain\WantedRole\Factory\WantedRoleFactory;
use App\Domain\WantedRole\ValueObject\WantedMemberList;
use App\Exceptions\DomainException;

class GuildService
{
    protected $partyFactory;
    protected $productionIdeaFactory;
    protected $guildMemberRepository;
    protected $partyRepository;
    protected $wantedRoleFactory;
    protected $wantedMemberFactory;

    function __construct(
        PartyFactory $partyFactory,
        ProductionIdeaFactory $productionIdeaFactory,
        GuildMemberRepositoryInterface $guildMemberRepository,
        PartyRepositoryInterface $partyRepository,
        WantedRoleFactory $wantedRoleFactory,
        WantedMemberFactory $wantedMemberFactory
    )
    {
        $this->partyFactory = $partyFactory;
        $this->productionIdeaFactory = $productionIdeaFactory;
        $this->guildMemberRepository = $guildMemberRepository;
        $this->partyRepository = $partyRepository;
        $this->wantedRoleFactory = $wantedRoleFactory;
        $this->wantedMemberFactory = $wantedMemberFactory;
    }

    public function partyRegister(PartyWrittenRequest $partyWrittenRequest): string
    {
        $productionIdeaInfo = $partyWrittenRequest->productionIdeaInfo();
        $productionIdea = $this->productionIdeaFactory->createProductionIdea(
            $productionIdeaInfo->productionTheme(),
            $productionIdeaInfo->productionType(),
            $productionIdeaInfo->ideaDescription()
        );


        $wantedRoles = [];
        foreach ($partyWrittenRequest->wantedRoleInfoList() as $wantedRoleInfo) {
            $wantedRole = $this->wantedRoleFactory->createWantedRole(
                $wantedRoleInfo->name(),
                $wantedRoleInfo->referenceJobId(),
                $wantedRoleInfo->remarks(),
                new WantedMemberList()
            );
            $wantedRole->wantedMemberList()->addFrame($wantedRoleInfo->frameAmount());
        }

        $party = $this->partyFactory->createParty(
            $partyWrittenRequest->activityEndDate(),
            $productionIdea,
            $partyWrittenRequest->applicantId(),
            [],
            $wantedRoles
        );

        if(!$this->partyRepository->save($party)) throw new DomainException();
        return $party->id();
    }
}