<?php

use App\Domain\Status\ValueObject\JobInfo;
use App\Services\Status\JobCreateService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = app(JobCreateService::class);

        $jobInfo = new JobInfo([
            "jobCode" => "job" . Str::random(4),
            "name" => "Job1",
            "imageUrl" => "https://placehold.jp/150x150.png",
            "memo" => "メモ"
        ]);

        $service->create($jobInfo);
    }
}
