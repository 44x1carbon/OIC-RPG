<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/09
 * Time: 14:46
 */

namespace App\Domain\Feed\Factory;


use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;

class FeedPartyMessageFactory implements FeedMessageFactoryInterface
{
    public function createFeedMessage($id)
    {
        /* @var PartyRepositoryInterface $partyRepository */
        $partyRepository = app(PartyRepositoryInterface::class);
        /* @var Party $party */
        $party = $partyRepository->findById($id);

        return "新しいパーティ\n「 ".$party->productionIdea()->productionTheme()." 」\n が公開されました。";
    }
}