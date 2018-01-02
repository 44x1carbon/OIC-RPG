<?php

use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repo = app(\App\Domain\Field\FieldRepositoryInterface::class);

        $fields = [
            new \App\Domain\Field\Field('情報処理IT'),
            new \App\Domain\Field\Field('ゲーム'),
            new \App\Domain\Field\Field('CG・映像・アニメーション'),
            new \App\Domain\Field\Field('デザイン・Web'),
        ];

        foreach ($fields as $field) {
            $repo->save($field);
        }
    }
}
