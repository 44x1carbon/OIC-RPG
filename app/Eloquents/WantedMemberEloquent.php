<?php

namespace App\Eloquents;

use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\WantedMember\ValueObjects\WantedStatus;
use App\Domain\WantedMember\WantedMember;
use Illuminate\Database\Eloquent\Model;

class WantedMemberEloquent extends Model
{
    protected $table = 'wanted_members';

    /** リレーション定義 */
    public function wantedRoleEloquent()
    {
        return $this->belongsTo(WantedRoleEloquent::class, 'wanted_role_id');
    }

    /**
     * $parentModelないから、引数で与えられたWantedMemberのIdからEloquentを検索し、なければ新しく作る
     */
    public static function findOrNewModel(WantedMember $wantedMember, WantedRoleEloquent $parentModel): WantedMemberEloquent
    {
        return $parentModel
            ->wantedMemberEloquents()
            ->where('wanted_member_id', $wantedMember->id())
            ->firstOrNew([]);
    }

    /**
     * ドメインオブジェクトを利用して永続化&親とのリレーションをはる
     */
    public static function saveDomainObject(WantedMember $wantedMember, WantedRoleEloquent $parentModel)
    {
        $model = self::findOrNewModel($wantedMember, $parentModel);
        $model->setAttrByEntity($wantedMember);
        $model->wantedRoleEloquent()->associate($parentModel);
        return $model->save();
    }

    /**
     * ドメインオブジェクトからEloquentの属性をセットする
     */
    public function setAttrByEntity(WantedMember $wantedMember): WantedMemberEloquent
    {
        $this->wanted_member_id = $wantedMember->id();
        $this->wanted_status = $wantedMember->wantedStatus()->status();
        $this->officer_id = null_safety($wantedMember->officerId(), function(StudentNumber $officerId) {
            return $officerId->code();
        });

        return $this;
    }

    /**
     * Eloquentからドメインオブジェクトへ変換する
     */
    public function toEntity(): WantedMember
    {
        return new WantedMember(
            $this->wanted_member_id,
            new WantedStatus($this->wanted_status),
            null_safety($this->officer_id, function($id) {
                new StudentNumber($id);
            })
        );
    }
}
