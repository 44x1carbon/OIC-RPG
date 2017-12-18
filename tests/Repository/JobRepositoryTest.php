<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/12/08
 * Time: 16:27
 */

namespace Tests\Repository;


use App\Domain\GetCondition\GetCondition;
use App\Domain\Job\Job;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\Job\Spec\JobIdSpec;
use App\Domain\Job\ValueObjects\JobId;
use App\Eloquents\JobEloquent;
use Tests\TestCase;

class JobRepositoryTest extends TestCase
{
    /* @var JobRepositoryInterface $jobRepository */
    protected $jobRepository;

    /* @var Job $job */
    private $job;

    /* @var Job $job1 */
    private $job1;

    public function setUp()
    {
        parent::setUp();

        $this->jobRepository = app(JobRepositoryInterface::class);

        $jobId = $this->jobRepository->nextId();
        $getConditionArray = [];
        $getCondition = new GetCondition('aaaa', 15);
        $getCondition1 = new GetCondition('bbbb', 10);
        $getConditionArray[] = $getCondition;
        $getConditionArray[] = $getCondition1;

        $this->job = new Job(
            $jobId,
            'サーバーサイドマスター',
            'hoge\hogehoge',
            $getConditionArray);

        $jobId1 = $this->jobRepository->nextId();
        $getConditionArray1 = [];
        $getCondition2 = new GetCondition('eeee', 15);
        $getCondition3 = new GetCondition('ffff', 10);
        $getConditionArray1[] = $getCondition2;
        $getConditionArray1[] = $getCondition3;

        $this->job1 = new Job(
            $jobId1,
            'サーバーサイドマスター',
            'hoge\hogehoge',
            $getConditionArray);

        $this->jobRepository->save($this->job);
        $this->jobRepository->save($this->job1);
    }

    public function testFindById()
    {
        $result = $this->jobRepository->findById($this->job->jobId()->code());
        $this->assertTrue($result->jobId()->code() === $this->job->jobId()->code()
                                   && $result->jobName() === $this->job->jobName()
                                   && $result->imagePath() === $this->job->imagePath());
    }

    public function testNextId()
    {
        $nextId = $this->jobRepository->nextId();

        $this->assertTrue(is_null($this->jobRepository->findById($nextId->code())));
    }

    public function testSave()
    {
        $jobId = $this->jobRepository->nextId();

        $getConditionArray = [];
        $getCondition = new GetCondition('cccc', 15);
        $getCondition1 = new GetCondition('dddd', 10);
        $getConditionArray[] = $getCondition;
        $getConditionArray[] = $getCondition1;

        $this->job = new Job(
            $jobId,
            'フロントマスター',
            'hoge\hogehoge',
            $getConditionArray);

        $this->assertTrue($this->jobRepository->save($this->job));
    }


    public function testAll()
    {
        $registerJobs[] = $this->job;
        $registerJobs[] = $this->job1;
        $registerJobIds = [];

        $getAllJobs = $this->jobRepository->all();
        $getAllJobIds = [];
        
        /* @var Job $job */
        foreach ($getAllJobs as $job)
        {
            $getAllJobIds[] = $job->jobId()->code();
        }

        foreach ($registerJobs as $job)
        {
            $registerJobIds[] = $job->jobId()->code();
        }

        $this->assertTrue(empty(array_diff($registerJobIds, $getAllJobIds)));
    }


}
