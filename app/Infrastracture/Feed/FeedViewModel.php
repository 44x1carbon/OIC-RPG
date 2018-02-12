<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/09
 * Time: 1:12
 */

namespace App\Infrastracture\Feed;


use App\Domain\Feed\Feed;
use App\Infrastracture\Link\LinkViewModel;
use DateTime;

class FeedViewModel
{
    private $feed;
    private $message = null;            // メッセージ
    private $link = null;               // リンクVO
    private $createdAt = null;          // Feed元の作成い日時

    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
        $this->message = $feed->message();
        $this->link = new LinkViewModel($feed->link());
        $this->createdAt = $feed->createdAt();
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * @return LinkViewModel
     */
    public function link(): LinkViewModel
    {
        return $this->link;
    }

    /**
     * Feed元の作成日時
     * @return \DateTime
     */
    public function createdAt(): DateTime
    {
        return $this->createdAt;
    }
}