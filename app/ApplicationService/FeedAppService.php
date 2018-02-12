<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/09
 * Time: 14:18
 */

namespace App\ApplicationService;


use App\Domain\Feed\Factory\FeedFactory;
use App\Domain\Party\Party;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;

class FeedAppService
{
    private $feedFactory;
    private $partyRepository;

    public function __construct(
        FeedFactory $feedFactory,
        PartyRepositoryInterface $partyRepository
    )
    {
        $this->feedFactory = $feedFactory;
        $this->partyRepository = $partyRepository;
    }

    /**
     * 最新のFeedを取得する
     */
    public function feed()
    {
        $feedList[] = $this->feedNewParty();

        // Feed元の作成日付でソート
        usort($feedList, function ($feed1, $feed2)
        {
            return $feed1->createdAt() <=> $feed2->createdAt();
        });
        // ソートしたFeedから5つ取得
        return array_slice($feedList[0],  0,5);
    }

    /**
     * 新しく作成されたパーティのFeedを5件取得する
     */
    private function feedNewParty()
    {
        $parties = $this->partyRepository->takeNewParty(5);

        return array_map(function(Party $party) {
            return $this->feedFactory->createPartyFeed($party);
        }, $parties);
    }
}