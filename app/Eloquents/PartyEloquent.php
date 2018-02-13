<?php

namespace App\Eloquents;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\Party\Party;
use App\Domain\Party\ValueObjects\ActivityEndDate;
use Illuminate\Database\Eloquent\Model;

class PartyEloquent extends Model
{
    protected $table = 'parties';

    /** リレーション定義 */
    public function productionIdeaEloquent()
    {
        return $this->hasOne(ProductionIdeaEloquent::class, 'party_id');
    }

    public function wantedRoleEloquents()
    {
        return $this->hasMany(WantedRoleEloquent::class, 'party_id');
    }

    /**
     * ドメインオブジェクトを利用して永続化&親とのリレーションをはる
     */
    public static function saveDomainObject(Party $party): bool
    {
        $model = self::findOrNewModel($party);
        $model->setAttrByEntity($party);
        $result = $model->save();
        $result = ProductionIdeaEloquent::saveDomainObject($party->productionIdea(), $model) ? $result : false;

        foreach ($party->wantedRoles() as $wantedRole) {
            $result = WantedRoleEloquent::saveDomainObject($wantedRole, $model) ? $result : false;
        }

        return $result;
    }

    /**
     * 引数で与えられたPartyのIdからEloquentを検索し、なければ新しく作る
     */
    public static function findOrNewModel(Party $party): PartyEloquent
    {
        return self::where('party_id', $party->id())->firstOrNew([]);
    }

    /**
     * ドメインオブジェクトからEloquentの属性をセットする
     */
    public function setAttrByEntity(Party $party): PartyEloquent
    {
        $this->party_id = $party->id();
        $this->active_end_date = $party->activityEndDate()->date();
        $this->manager_id = $party->partyManagerId()->code();

        return $this;
    }

    /**
     * Eloquentからドメインオブジェクトへ変換する
     */
    public function toEntity(): Party
    {
        $productionIdea = $this->productionIdeaEloquent->toEntity();
        $wantedRoles = $this->wantedRoleEloquents->map(function(WantedRoleEloquent $model) {
            return $model->toEntity();
        })->toArray();

        return new Party(
            $this->party_id,
            new ActivityEndDate($this->active_end_date),
            new StudentNumber($this->manager_id),
            $productionIdea,
            $wantedRoles,
            new \DateTime($this->created_at)
        );
    }
}
