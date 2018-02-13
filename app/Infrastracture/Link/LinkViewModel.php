<?php

namespace App\Infrastracture\Link;

use App\Domain\Notification\ValueObjects\Link;
use App\Domain\Notification\ValueObjects\LinkType;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;

/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/09
 * Time: 1:22
 */

class LinkViewModel
{
    private $link;
    private $linkToId = null;
    private $linkType = null;

    private $partyParticipationRequestRepository;

    public function __construct(Link $link)
    {
        $this->link = $link;
        $this->linkToId = $link->linkToId();
        $this->linkType = $link->linkType();

        $this->partyParticipationRequestRepository = app(PartyParticipationRequestRepositoryInterface::class);
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
        if ($this->linkType && $this->linkType->isPartyParticipationRequest()) {
            return route('shoe_participation_request_list');
        } elseif ($this->linkType && $this->linkType->is('party')) {
            return route('show_party_detail', ['partyId' => $this->linkToId]);
        }
    }

    // LinkIdとタイプを元にパーティへのURLが作成出来る場合は作成して渡す
    public function partyUrl()
    {
        if ($this->linkType && $this->linkType->is('party')) {
            return route('show_party_detail', ['partyId' => $this->linkToId]);
        } elseif ($this->linkType && $this->linkType->isPartyParticipationRequest()) {
            $partyId = $this->partyParticipationRequestRepository->findById($this->linkToId())->partyId();
            return route('show_party_detail', ['partyId' => $partyId]);
        }
        return null;
    }

    public function label(): string
    {
        if($this->linkType->is(LinkType::PARTY_PARTICIPATION_REQUEST)) {
            return "参加申請一覧へ";
        } else
        if($this->linkType->is(LinkType::PARTY)) {
            return "パーティ詳細へ";
        } else {
            return "";
        }
    }
}