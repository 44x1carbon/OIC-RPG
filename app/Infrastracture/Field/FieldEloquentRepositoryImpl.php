<?php

namespace App\Infrastracture\Field;

use App\Domain\Field\Field;
use App\Domain\Field\FieldRepositoryInterface;
use App\Domain\Job\ValueObjects\JobId;
use App\Eloquents\FieldCourseIdEloquent;
use App\Eloquents\FieldEloquent;
use App\Eloquents\FieldJobIdEloquent;
use App\Eloquents\FieldSkillIdEloquent;

class FieldEloquentRepositoryImpl implements FieldRepositoryInterface
{
    protected $eloquent;

    function __construct(FieldEloquent $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param Field $field
     * @return bool
     */
    public function save(Field $field): bool
    {
        /* @var FieldEloquent $model */
        $model = $this->eloquent->firstOrNew([ 'name' => $field->name()]);
        $model->save();

        $model->fieldCourseIds()->delete();
        $model->fieldCourseIds()->saveMany(array_map(function(string $courseId) use($model) {
            return new FieldCourseIdEloquent([
                'field_id' => $model->id,
                'course_id' => $courseId
            ]);
        }, $field->courseIdList()));

        $model->fieldJobIds()->delete();
        $model->fieldJobIds()->saveMany(array_map(function(JobId $jobId) use($model) {
            return new FieldJobIdEloquent([
                'field_id' => $model->id,
                'job_id' => $jobId->code()
            ]);
        }, $field->jobIdList()));

        $model->fieldSkillIds()->delete();
        $model->fieldSkillIds()->saveMany(array_map(function(string $skillId) use($model) {
            return new FieldSkillIdEloquent([
                'field_id' => $model->id,
                'skill_id' => $skillId
            ]);
        }, $field->skillIdList()));

        return true;
    }

    /**
     * 分野名からFieldインスタンスを取得する
     *
     * @param string $name
     * @return Field
     */
    public function findByName(string $name): ?Field
    {
        return null_safety($this->eloquent->where('name', $name )->first(), function(FieldEloquent $model) {
            return $model->toEntity();
        });
    }

    /**
     * コースIDからそのコースが所属しているFieldインスタンスを取得する
     *
     * @param string $courseId
     * @return Field
     */
    public function findByCourseId(string $courseId): ?Field
    {
        $fieldId = FieldCourseIdEloquent::where('course_id', $courseId)->first()->field_id;

        return null_safety($this->eloquent->find($fieldId), function(FieldEloquent $model) {
            return $model->toEntity();
        });
    }

    /**
     * ジョブIDからそのジョブが所属しているFieldインスタンスを取得する
     *
     * @param JobId $jobId
     * @return Field
     */
    public function findByJobId(JobId $jobId): ?Field
    {
        $fieldId = FieldJobIdEloquent::where('job_id', $jobId->code())->first()->field_id;

        return null_safety($this->eloquent->find($fieldId), function(FieldEloquent $model) {
            return $model->toEntity();
        });
    }

    /**
     * すべてのFieldインスタンスを取得する
     *
     * @return array
     */
    public function all(): array
    {
        return $this->eloquent->all()->map(function(FieldEloquent $model) {
           return $model->toEntity();
        })->toArray();
    }

    /**
     * スキルIDからそのスキルが所属しているFieldインスタンスを取得する
     *
     * @param string $skillId
     * @return Field|null
     */
    public function findBySkillId(string $skillId): ?Field
    {
        $fieldId = FieldSkillIdEloquent::where('skill_id', $skillId)->first()->field_id;

        return null_safety($this->eloquent->find($fieldId), function(FieldEloquent $model) {
            return $model->toEntity();
        });
    }
}