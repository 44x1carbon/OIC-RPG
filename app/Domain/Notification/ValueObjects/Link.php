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
}