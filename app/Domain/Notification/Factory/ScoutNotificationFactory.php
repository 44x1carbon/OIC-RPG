<?php

namespace App\Domain\Notification\Factory;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Notification\Notification;
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;
use App\Domain\Notification\ValueObjects\Link;
use App\Domain\Notification\ValueObjects\LinkType;
use App\Domain\Notification\ValueObjects\NotificationType;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\Scout\Scout;

class ScoutNotificationFactory implements NotificationTextFactoryInterface
{
    /* @var NotificationRepositoryInterface $repository*/
    private $repository;

    function __construct(Scout $scout)
    {
        $this->scout = $scout;
        $this->repository = app(NotificationRepositoryInterface::class);
        /* @var PartyRepositoryInterface $partyRepository */
        $partyRepository = app(PartyRepositoryInterface::class);
        $this->party = $partyRepository->findById($this->scout->partyId);
    }

    public function createTitle(string $id): string
    {
        return "「{$this->party->productionIdea()->productionTheme()}」からスカウトが来ています";
    }

    public function createMessage(string $id): string
    {
        return "管理者からのメッセージ\n{$this->scout->message}";
    }

    public function to(): StudentNumber
    {
        return $this->scout->to;
    }

    public function link(): Link
    {
        return new Link(
            $this->scout->partyId,
            LinkType::PARTY()
        );
    }

    public function build(): Notification
    {
        return new Notification(
            $this->repository->nextId(),
            $this->createTitle('none'),
            $this->createMessage('none'),
            $this->to(),
            $this->link(),
            NotificationType::SCOUT()
        );
    }
}