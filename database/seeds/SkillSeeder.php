<?php

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skillFactory = app(\App\Domain\Skill\Factory\SkillFactory::class);
        $skillRepo = app(\App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface::class);
        $fieldRepo = app(\App\Domain\Field\FieldRepositoryInterface::class);

        $fields = [
            '情報処理IT' => [
                $skillFactory->createSkill('Java'),
                $skillFactory->createSkill('Android'),
                $skillFactory->createSkill('PHP'),
                $skillFactory->createSkill('HTML'),
                $skillFactory->createSkill('CSS'),
                $skillFactory->createSkill('JavaScript'),
                $skillFactory->createSkill('ネットワーク'),
                $skillFactory->createSkill('Linux'),
            ],
            'ゲーム' => [
                $skillFactory->createSkill('C++'),
                $skillFactory->createSkill('Unity'),
                $skillFactory->createSkill('モーション'),
                $skillFactory->createSkill('マーケティング'),
            ],
            'CG・映像・アニメーション' => [
                $skillFactory->createSkill('撮影'),
                $skillFactory->createSkill('編集'),
                $skillFactory->createSkill('3DCG'),
            ],
            'デザイン・Web' => [
                $skillFactory->createSkill('デッサン'),
                $skillFactory->createSkill('Illustrator'),
                $skillFactory->createSkill('色彩'),
            ],
        ];

        foreach ($fields as $fieldName => $skills) {
            foreach ($skills as $skill) {
                $skillRepo->save($skill);
            }

            /* @var \App\Domain\Field\Field $field */
            $field = $fieldRepo->findByName($fieldName);
            $field->setSkillIdList(array_map(function(\App\Domain\Skill\Skill $skill){
                return $skill->skillId();
            }, $skills));

            $fieldRepo->save($field);
        }
    }
}
