<?php

use App\Domain\Course\Course;
use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /* @var CourseRepositoryInterface $repo */
    protected $repo;
    /* @var \App\Domain\Field\FieldRepositoryInterface $fieldRepo */
    private $fieldRepo;

    function __construct()
    {
        $this->repo = app(CourseRepositoryInterface::class);
        $this->fieldRepo = app(\App\Domain\Field\FieldRepositoryInterface::class);
    }

    public function run()
    {
        $fields = [
            '情報処理IT' => [
                [ 'id' => 'it1', 'name' => 'ITスペシャリスト専攻'],
                [ 'id' => 'it2', 'name' => 'システムエンジニア専攻'],
                [ 'id' => 'it3', 'name' => 'テクニカルコース'],
                [ 'id' => 'it4', 'name' => 'ネットワークセキュリティ専攻'],
                [ 'id' => 'it5', 'name' => 'ネットワークエンジニア専攻'],
                [ 'id' => 'it6', 'name' => 'Webエンジニア専攻'],
                [ 'id' => 'it7', 'name' => 'ネットワークシステムコース'],
            ],
            'ゲーム' => [
                [ 'id' => 'game1', 'name' => 'ゲームプログラマー専攻'],
                [ 'id' => 'game2', 'name' => 'ゲームデザイナー専攻'],
                [ 'id' => 'game3', 'name' => 'ゲームプランナー専攻'],
                [ 'id' => 'game4', 'name' => 'ゲームクリエイター専攻(PG)'],
                [ 'id' => 'game5', 'name' => 'ゲームクリエイター専攻(CG)'],
                [ 'id' => 'game6', 'name' => 'ゲームプログラムコース'],
                [ 'id' => 'game7', 'name' => 'ゲームCGデザインコース'],
            ],
            'CG・映像・アニメーション' => [
                [ 'id' => 'movie1', 'name' => 'CG映像クリエイター専攻'],
                [ 'id' => 'movie2', 'name' => 'CGクリエイター専攻'],
                [ 'id' => 'movie3', 'name' => 'CG映像コース'],
                [ 'id' => 'movie4', 'name' => 'CGアニメーションコース'],
            ],
            'デザイン・Web' => [
                [ 'id' => 'design1', 'name' => 'アートディレクター専攻'],
                [ 'id' => 'design2', 'name' => 'Webデザインコース'],
                [ 'id' => 'design3', 'name' => 'グラフィックデザインコース'],
                [ 'id' => 'design4', 'name' => 'マンガイラストコース'],
            ],
        ];

        foreach ($fields as $fieldName => $courses) {
            foreach ($courses as $course) {
                $this->repo->save(new Course($course['id'], $course['name']));
            }

            /* @var \App\Domain\Field\Field $field */
            $field = $this->fieldRepo->findByName($fieldName);
            $field->setCourseIdList(array_map(function($v) { return $v['id']; }, $courses));
            $this->fieldRepo->save($field);
        }
    }
}