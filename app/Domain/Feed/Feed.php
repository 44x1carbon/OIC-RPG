<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/06
 * Time: 12:11
 */

namespace App\Domain\Feed;


use App\Domain\Notification\ValueObjects\Link;

class Feed
{
    private $message;       // Feedに表示する文言
    private $link;          // Feedから飛べるリンク
    private $createdAt;     // Feedにする物の作成された日付

    public function __construct(string $message, Link $link, \DateTime $createdAt)
    {
        $this->message = $message;
        $this->link = $link;
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * @return Link
     */
    public function link(): Link
    {
        return $this->link;
    }

    /**
     * @return mixed
     */
    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }
}