<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/01/30
 * Time: 17:42
 */

namespace App\Domain\Notification\ValueObjects;


use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;

class Link
{
    /* @var PartyParticipationRequestRepositoryInterface $partyParticipationRequestRepository */
    private $partyParticipationRequestRepository;

    private $linkToId;
    private $linkType;

    public function __construct(string $linkToId, LinkType $linkType)
    {
        $this->partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);

        $this->linkToId = $linkToId;
        $this->linkType = $linkType;
    }

    public function linkToId()
    {
        return $this->linkToId;
    }

    public function linkType(): LinkType
    {
        return $this->linkType;
    }

    // LinkIdとタイプを元にURLを作成する
    public function url()
    {
        if ($this->linkType->isPartyParticipationRequest()) {
            return route('shoe_participation_request_list');
        } elseif ($this->linkType->isParty()) {
            return route('show_party_detail', ['partyId' => $this->linkToId]);
        }
    }

    // LinkIdとタイプを元にパーティへのURLが作成出来る場合は作成して渡す
    public function partyUrl()
    {
        if ($this->linkType->isParty()) {
            return route('show_party_detail', ['partyId' => $this->linkToId]);
        } elseif ($this->linkType->isPartyParticipationRequest()) {
            $partyId = $this->partyParticipationRequestRepository->findById($this->linkToId())->partyId();
            return route('show_party_detail', ['partyId' => $partyId]);
        }
        return null;
    }
}