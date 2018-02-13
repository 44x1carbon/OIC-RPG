<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/06
 * Time: 13:06
 */

namespace App\Domain\Feed\Factory;


use App\Domain\Feed\Feed;
use App\Domain\Notification\ValueObjects\Link;
use App\Domain\Notification\ValueObjects\LinkType;
use App\Domain\Party\Party;

class FeedFactory
{
    private $feedPartyMessageFactory;

    public function __construct(FeedPartyMessageFactory $feedPartyMessageFactory)
    {
        $this->feedPartyMessageFactory = $feedPartyMessageFactory;
    }

    public function createPartyFeed(Party $party)
    {
        return new Feed($this->feedPartyMessageFactory->createFeedMessage($party->id()),new Link($party->id(), LinkType::PARTY()), $party->createdAt());
    }
}