<?php

namespace App\Eloquents;

use App\Domain\WantedMember\WantedMember;
use App\Domain\WantedRole\WantedRole;
use Illuminate\Database\Eloquent\Model;

class WantedRoleEloquent extends Model
{
    protected $table = 'wanted_roles';

    /** リレーション定義 */
    public function wantedMemberEloquents()
    {
        return $this->hasMany(WantedMemberEloquent::class, 'wanted_role_id');
    }

    public function partyEloquent()
    {
        return $this->belongsTo(PartyEloquent::class, 'party_id');
    }

    /**
     * $parentModelないから、引数で与えられたWantedRoleのIdからEloquentを検索し、なければ新しく作る
     */
    public static function findOrNewModel(WantedRole $wantedRole, PartyEloquent $parentModel)
    {
        return $parentModel
            ->wantedRoleEloquents()
            ->where('wanted_role_id', $wantedRole->id())
            ->firstOrNew([]);
    }

    /**
     * ドメインオブジェクトを利用して永続化&親とのリレーションをはる
     */
    public static function saveDomainObject(WantedRole $wantedRole, PartyEloquent $parentModel)
    {
        $model = self::findOrNewModel($wantedRole, $parentModel);
        $model->setAttrByEntity($wantedRole);
        $model->partyEloquent()->associate($parentModel);
        $result = $model->save();

        foreach ($wantedRole->wantedMemberList()->all() as $wantedMember) {
            $result = WantedMemberEloquent::saveDomainObject($wantedMember, $model)? $result : false;
        }

        return $result;
    }

    /**
     * ドメインオブジェクトからEloquentの属性をセットする
     */
    public function setAttrByEntity(WantedRole $wantedRole): WantedRoleEloquent
    {
        $this->wanted_role_id = $wantedRole->id();
        $this->role_name = $wantedRole->roleName();
        $this->remarks = $wantedRole->remarks();
        $this->reference_job_id = $wantedRole->referenceJobId();

        return $this;
    }

    /**
     * Eloquentからドメインオブジェクトへ変換する
     */
    public function toEntity(): WantedRole
    {
        $wantedMembers = $this->wantedMemberEloquents->map(function(WantedMemberEloquent $model) {
           return $model->toEntity();
        })->toArray();

        $entity = new WantedRole(
            $this->wanted_role_id,
            $this->role_name,
            $this->reference_job_id,
            $this->remarks,
            $wantedMembers
        );

        return $entity;
    }
}
