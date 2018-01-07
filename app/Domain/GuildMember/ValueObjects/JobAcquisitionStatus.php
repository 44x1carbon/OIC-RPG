<?php

namespace App\Domain\GuildMember\ValueObjects;

/**
 * Class JobAcquisitionStatus
 * @package App\Domain\GuildMember\ValueObjects
 */
class JobAcquisitionStatus
{
    const NOT_LEARNED = 'not_learned';
    const LEARNED = 'learned';
    const GETTABLE = 'gettable';

    private $status;

    /**
     * JobAcquisitionStatus constructor.
     * @param string $status
     */
    private function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
     * 未習得状態を示すインスタンスを生成する
     * @return JobAcquisitionStatus
     */
    public static function notLearned(): JobAcquisitionStatus
    {
        return new static(self::NOT_LEARNED);
    }

    /**
     * 習得状態を示すインスタンスを生成する
     * @return JobAcquisitionStatus
     */
    public static function learned(): JobAcquisitionStatus
    {
        return new static(self::LEARNED);
    }

    /**
     * 習得可能状態を示すインスタンスを生成する
     * @return JobAcquisitionStatus
     */
    public static function gettable(): JobAcquisitionStatus
    {
        return new static(self::GETTABLE);
    }

    /**
     * @return string
     */
    public function status(): string
    {
        return $this->status;
    }
}