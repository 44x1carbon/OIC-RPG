<?php

namespace App\Domain\Field;

use App\Domain\Job\Job;
use App\Domain\Job\JobRepositoryInterface;

class Field
{
    private $name;
    private $jobIdList;
    private $courseIdList;

    const DEFAULT_JOB_LIST = [
        '情報処理IT' => '学生(IT)',
        'ゲーム' => '学生(ゲーム)',
        'CG・映像・アニメーション' => '学生(映像)',
        'デザイン・Web' => '学生(デザイン)',
    ];

    public function __construct(string $name, array $jobIdList = [], array $courseIdList = [])
    {
        $this->name = $name;
        $this->jobIdList = $jobIdList;
        $this->courseIdList = $courseIdList;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function jobIdList(): array
    {
        return $this->jobIdList;
    }

    /**
     * @return array
     */
    public function courseIdList(): array
    {
        return $this->courseIdList;
    }

    public function defaultJob(): Job
    {
        /* @var JobRepositoryInterface $jobRepo */
        $jobRepo = app(JobRepositoryInterface::class);
        return $jobRepo->findByName(self::DEFAULT_JOB_LIST[$this->name]);
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param array $jobIdList
     */
    public function setJobIdList(array $jobIdList)
    {
        $this->jobIdList = $jobIdList;
    }

    /**
     * @param array $courseIdList
     */
    public function setCourseIdList(array $courseIdList)
    {
        $this->courseIdList = $courseIdList;
    }
}