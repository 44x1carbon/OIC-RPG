<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/07
 * Time: 12:51
 */

namespace App\Domain\Feed\Factory;

interface FeedMessageFactoryInterface
{
    public function createFeedMessage($id);
}