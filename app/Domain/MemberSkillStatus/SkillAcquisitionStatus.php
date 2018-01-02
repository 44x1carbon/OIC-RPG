<?php

namespace App\Domain\MemberSkillStatus;

/**
 * スキルを取得しているかどうかの状態を表現するドメインモデル
 * Class SkillAcquisitionStatus
 * @package App\Domain\MemberSkillStatus
 */
class SkillAcquisitionStatus
{
    /** スキルの習得状況を表す */
    protected $status;

    /** 未習得状態を表す文字列*/
    private const NOT_LEARNED = 'not_learned';
    /** 習得状態を表す文字列*/
    private const LEARNED = 'learned';

    /**
     * SkillAcquisitionStatus constructor.
     * @param string $status
     */
    private function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
     * 未取得状態のSkillAcquisitionStatusのインスタンスを生成する
     * @return SkillAcquisitionStatus
     */
    public static function NOT_LEARNED(): SkillAcquisitionStatus
    {
        return new SkillAcquisitionStatus(self::NOT_LEARNED);
    }

    /**
     * 取得状態のSkillAcquisitionStatusのインスタンスを生成する
     * @return SkillAcquisitionStatus
     */
    public static function LEARNED(): SkillAcquisitionStatus
    {
        return new SkillAcquisitionStatus(self::LEARNED);
    }

    /**
     * @return bool
     */
    public function isNotLearned(): bool
    {
        return $this->status === self::NOT_LEARNED;
    }

    /**
     * @return bool
     */
    public function isLearned(): bool
    {
        return $this->status === self::LEARNED;
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }
}