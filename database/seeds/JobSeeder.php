<?php

use App\Domain\Skill\Skill;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /* @var \App\Domain\Field\FieldRepositoryInterface $fieldRepo */
    private $fieldRepo;

    function __construct(\App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface $skillRepository)
    {
        $this->skills = $skillRepository->all();
        $this->fieldRepo = app(\App\Domain\Field\FieldRepositoryInterface::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* @var \App\Presentation\Job\JobServiceFacade $jobServiceFacade */
        $jobServiceFacade = app(\App\Presentation\Job\JobServiceFacade::class);

        $fields = [
            '情報処理IT' => [
                [
                    'name' => '学生(IT)',
                    'path' => 'it_nojob',
                    'conditions' => []
                ],
                [
                    'name' => 'Webエンジニア',
                    'path' => 'web_engineer',
                    'conditions' => [
                        [ 'PHP', 3 ], [ 'HTML', 1 ], [ 'JavaScript', 3 ], [ 'CSS', 1 ],
                    ]
                ],
                [
                    'name' => 'ネットワークエンジニア',
                    'path' => 'network_engineer',
                    'conditions' => [
                        [ 'ネットワーク', 5 ], [ 'Linux', 5 ],
                    ]
                ],
            ],
            'ゲーム' => [
                [
                    'name' => '学生(ゲーム)',
                    'path' => 'game_nojob',
                    'conditions' => []
                ],
                [
                    'name' => 'ゲームプログラマー',
                    'path' => 'game_programmer',
                    'conditions' => [
                        [ 'C++', 5 ], [ 'Unity', 5 ],
                    ]
                ],
                [
                    'name' => 'ゲームグラフィッカー',
                    'path' => 'game_graphicer',
                    'conditions' => [
                        [ 'デッサン', 3 ], [ 'モーション', 3 ], [ '色彩', 3 ],
                    ]
                ],
            ],
            'CG・映像・アニメーション' => [
                [
                    'name' => '学生(映像)',
                    'path' => 'movie_nojob',
                    'conditions' => []
                ],
                [
                    'name' => '3DCGデザイナー',
                    'path' => '3dcg_designer',
                    'conditions' => [
                        [ '3DCG', 5 ], [ 'モーション', 5 ],
                    ]
                ],
                [
                    'name' => '映像クリエイター',
                    'path' => 'movie_creater',
                    'conditions' => [
                        [ '撮影', 5 ], [ '編集', 5 ],
                    ]
                ],
            ],
            'デザイン・Web' => [
                [
                    'name' => '学生(デザイン)',
                    'path' => 'design_nojob',
                    'conditions' => []
                ],
                [
                    'name' => 'イラストレーター',
                    'path' => 'illustrator',
                    'conditions' => [
                        [ '色彩', 5 ], [ 'デッサン', 5 ],
                    ]
                ],
                [
                    'name' => 'Webデザイナー',
                    'path' => 'web_designer',
                    'conditions' => [
                        [ 'HTML', 3 ], [ 'CSS', 3 ], [ '色彩', 3 ], [ 'デッサン', 3 ],
                    ]
                ],
                [
                    'name' => 'グラフィックデザイナー',
                    'path' => 'graphic_designer',
                    'conditions' => [
                        [ '色彩', 3 ], [ 'デッサン', 3 ], [ 'Illustrator', 3 ],
                    ]
                ],
            ],
        ];

        foreach ($fields as $fieldName => $jobs) {
            $jobIds = [];
            foreach ($jobs as $job) {
                $jobIdStr = $jobServiceFacade->registerJob($job['name'], $job['path'], $this->makeGetConditions($job['conditions']));
                $jobIds[] = new \App\Domain\Job\ValueObjects\JobId($jobIdStr);
            }

            /* @var \App\Domain\Field\Field $field */
            $field = $this->fieldRepo->findByName($fieldName);
            $field->setJobIdList($jobIds);
            $this->fieldRepo->save($field);
        }
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
