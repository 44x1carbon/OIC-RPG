<?php
/**
 * Created by PhpStorm.
 * User: yamagon
 * Date: 2018/02/02
 * Time: 9:48
 */

namespace App\Domain\Notification\Spec;


use App\Domain\Notification\ValueObjects\LinkType;
use App\DomainUtility\SpecTrait;

class LinkTypeSpec
{
    use SpecTrait;

    public static function isAvailable(String $type): bool
    {
        //受け取った値が利用可能か判定
        $list = LinkType::TYPE_LIST;
        return in_array($type,$list);
    }
}