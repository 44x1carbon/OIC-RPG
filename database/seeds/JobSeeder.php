<?php

use App\Domain\Skill\Skill;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    function __construct(\App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface $skillRepository)
    {
        $this->skills = $skillRepository->all();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobServiceFacade = app(\App\Presentation\Job\JobServiceFacade::class);

        $jobServiceFacade->registerJob('学生(IT)', 'job/it_nojob.png', $this->makeGetConditions([]));
        $jobServiceFacade->registerJob('学生(ゲーム)', 'job/game_nojob.png', $this->makeGetConditions([]));
        $jobServiceFacade->registerJob('学生(デザイン)', 'job/design_nojob.png', $this->makeGetConditions([]));
        $jobServiceFacade->registerJob('学生(映像)', 'job/movie_nojob.png', $this->makeGetConditions([]));

        $jobServiceFacade->registerJob('Webエンジニア', 'job/web_engineer.png', $this->makeGetConditions([
            [ 'PHP', 3 ], [ 'HTML', 1 ], [ 'JavaScript', 3 ], [ 'CSS', 1 ],
        ]));
        $jobServiceFacade->registerJob('ネットワークエンジニア', 'job/infra_engineer.png', $this->makeGetConditions([
            [ 'ネットワーク', 5 ], [ 'Linux', 5 ],
        ]));

        $jobServiceFacade->registerJob('ゲームプログラマー', 'job/game_programmer.png', $this->makeGetConditions([
            [ 'C++', 5 ], [ 'Unity', 5 ],
        ]));
        $jobServiceFacade->registerJob('ゲームグラフィッカー', 'job/game_graphicer.png', $this->makeGetConditions([
            [ 'デッサン', 3 ], [ 'モーション', 3 ], [ '色彩', 3 ],
        ]));
        $jobServiceFacade->registerJob('ゲームプランナー', 'job/game_planner.png', $this->makeGetConditions([
            [ 'Unity', 3 ], [ 'デッサン', 3 ], [ 'マーケティング', 3 ]
        ]));

        $jobServiceFacade->registerJob('イラストレーター', 'job/illustrator.png', $this->makeGetConditions([
            [ '色彩', 5 ], [ 'デッサン', 5 ],
        ]));
        $jobServiceFacade->registerJob('Webデザイナー', 'job/web_designer.png', $this->makeGetConditions([
            [ 'HTML', 3 ], [ 'CSS', 3 ], [ '色彩', 3 ], [ 'デッサン', 3 ],
        ]));
        $jobServiceFacade->registerJob('グラフィックデザイナー', 'job/graphic_designer.png', $this->makeGetConditions([
            [ '色彩', 3 ], [ 'デッサン', 3 ], [ 'Illustrator', 3 ],
        ]));

        $jobServiceFacade->registerJob('3DCGデザイナー', 'job/3dcg_designer.png', $this->makeGetConditions([
            [ '3DCG', 5 ], [ 'モーション', 5 ],
        ]));
        $jobServiceFacade->registerJob('映像クリエイター', 'job/movie_creater.png', $this->makeGetConditions([
            [ '撮影', 5 ], [ '編集', 5 ],
        ]));
    }

    public function makeGetConditions($data): array
    {
        return array_map(function($d) {
            $skill = $this->searchSkillByName($d[0]);
            return new \App\Domain\GetCondition\GetCondition($skill->skillId(), $d[1]);
        }, $data);
    }

    public function searchSkillByName($skillName): Skill
    {
        $result = array_filter($this->skills, function(Skill $skill) use($skillName) {
            return $skill->skillName() === $skillName;
        });

        $result = array_values($result);

        if(count($result) === 0) throw new Exception("$skillName not found");
        return $result[0];
    }
}
