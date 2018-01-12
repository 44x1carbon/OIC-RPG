<?php

namespace App\Eloquents;

use App\Domain\Field\Field;
use Illuminate\Database\Eloquent\Model;

class FieldEloquent extends Model
{
    protected $table = 'fields';

    protected $guarded = [];

    public function fieldCourseIds()
    {
        return $this->hasMany(FieldCourseIdEloquent::class, 'field_id');
    }

    public function fieldJobIds()
    {
        return $this->hasMany(FieldJobIdEloquent::class, 'field_id');
    }

    public function fieldSkillIds()
    {
        return $this->hasMany(FieldSkillIdEloquent::class, 'field_id');
    }

    public function toEntity(): Field
    {
        return new Field(
            $this->name,
            $this->jobIdsToVo(),
            $this->courseIdsToVo(),
            $this->skillIdsToVo()
        );
    }

    private function jobIdsToVo(): array
    {
        return $this->fieldJobIds->map(function(FieldJobIdEloquent $model) {
            return $model->toVo();
        })->toArray() ?? [];
    }

    private function courseIdsToVo(): array
    {
        return $this->fieldCourseIds->map(function(FieldCourseIdEloquent $model) {
            return $model->toVo();
        })->toArray() ?? [];
    }

    private function skillIdsToVo(): array
    {
        return $this->fieldSkillIds->map(function(FieldSkillIdEloquent $model) {
                return $model->toVo();
            })->toArray() ?? [];
    }
}
