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


        $skills = [
            $skillFactory->createSkill('Java'),
            $skillFactory->createSkill('Android'),
            $skillFactory->createSkill('PHP'),
            $skillFactory->createSkill('HTML'),
            $skillFactory->createSkill('CSS'),
            $skillFactory->createSkill('JavaScript'),
            $skillFactory->createSkill('ネットワーク'),
            $skillFactory->createSkill('Linux'),
            $skillFactory->createSkill('C++'),
            $skillFactory->createSkill('Unity'),
            $skillFactory->createSkill('デッサン'),
            $skillFactory->createSkill('Illustrator'),
            $skillFactory->createSkill('撮影'),
            $skillFactory->createSkill('編集'),
            $skillFactory->createSkill('3DCG'),
            $skillFactory->createSkill('モーション'),
            $skillFactory->createSkill('色彩'),
            $skillFactory->createSkill('マーケティング'),
        ];

        foreach ($skills as $skill) {
            $skillRepo->save($skill);
        }
    }
}
