<?php

namespace App\Eloquents;

use App\Domain\Notification\ValueObjects\Link;
use App\Domain\Notification\ValueObjects\LinkType;
use Illuminate\Database\Eloquent\Model;

class LinkEloquent extends Model
{
    protected $table = 'links';

    public static function findById(string $id): ?LinkEloquent
    {
        $linkModel = self::where('id', $id)->first();
        return $linkModel;
    }

    public static function findLinkToIdAndLinkType(string $linkToId, string $linkType)
    {
        $link = self::where('link_to_id', $linkToId)->where('link_type', $linkType)->first();
        return $link;
    }

    public static function fromVo(Link $link): LinkEloquent
    {
        $linkModel = self::findLinkToIdAndLinkType($link->linkToId(), $link->linkType()->type());

        if(is_null($linkModel))
        {
            $linkModel = new linkEloquent();
            $linkModel->id = null;
        }
        $linkModel->link_to_id               = $link->linkToId();
        $linkModel->link_type             = $link->linkType()->type();

        return $linkModel;
    }

    public function toVo(): Link
    {
        $vo = new Link(
            $this->link_to_id,
            new LinkType($this->link_type)
        );

        return $vo;
    }

    public static function saveDomainObject(Link $link)
    {
        $linkModel = self::findLinkToIdAndLinkType($link->linkToId(), $link->linkType()->type());
        // DBに同じ項目のデータが存在しなかった場合は作成する
        if (!$linkModel) {
            $linkModel = self::fromVo($link);
            $linkModel->save();
        }
        return $linkModel->id;
    }
}
