<?php

namespace App\Domain\Field;

use App\Domain\Job\ValueObjects\JobId;

interface FieldRepositoryInterface
{
    /**
     * @param Field $field
     * @return bool
     */
    public function save(Field $field): bool;

    /**
     * 分野名からFieldインスタンスを取得する
     *
     * @param string $name
     * @return Field
     */
    public function findByName(string $name): ?Field;

    /**
     * コースIDからそのコースが所属しているFieldインスタンスを取得する
     *
     * @param string $courseId
     * @return Field
     */
    public function findByCourseId(string $courseId): ?Field;

    /**
     * ジョブIDからそのジョブが所属しているFieldインスタンスを取得する
     *
     * @param JobId $jobId
     * @return Field
     */
    public function findByJobId(JobId $jobId): ?Field;

    /**
     * スキルIDからそのスキルが所属しているFieldインスタンスを取得する
     *
     * @param string $skillId
     * @return Field|null
     */
    public function findBySkillId(string $skillId): ?Field;

    /**
     * すべてのFieldインスタンスを取得する
     *
     * @return array
     */
    public function all(): array;
}