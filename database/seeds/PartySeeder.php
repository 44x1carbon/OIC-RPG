<?php

use App\Presentation\DTO\WantedRoleDto;
use Illuminate\Database\Seeder;

class PartySeeder extends Seeder
{
    use \Tests\Sampler;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partyServiceFacade = app(\App\Presentation\PartyServiceFacade::class);
        $productionTypeRepo = app(\App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface::class);
        $jobRepo            = app(\App\Domain\Job\JobRepositoryInterface::class);
        $partyRepo          = app(\App\Domain\Party\RepositoryInterface\PartyRepositoryInterface::class);

        $activeEndDate = \Carbon\Carbon::tomorrow()->format('Y-M-d');
        $productionTypeDto = new \App\Presentation\DTO\ProductionTypeDto(
            $productionTypeRepo->findByName('Webシステム')->id(),
            'Webシステム'
        );
        $productionIdeaDto = new \App\Presentation\DTO\ProductionIdeaDto(
            '学内での共同制作を推進するサービス',
            $productionTypeDto,
            '学内には様々なコースの優秀な学生がたくさんいます。現状、コース間での交流はほぼなく共同で作品を作る機会もありません。お互いが得意な分野で力を合わせることでより良い作品が作れると私は信じております。そこで学内での共同制作を推進するサービスを作成しようと考えています。スキルの可視化や制作メンバーの募集が主な機能になります。'
        );
        $partyDto = new \App\Presentation\DTO\PartyDto(
            $activeEndDate,
            $productionIdeaDto,
            [
                new WantedRoleDto(
                    'サーバーサイドエンジニア',
                    '言語はPHP、フレームワークはLaravelの5.4を利用します',
                    $jobRepo->findByName('Webエンジニア')->jobId()->code(),
                    3,
                    true
                ),
                new WantedRoleDto(
                    'Webデザイナー',
                    'スマホ用のWebアプリをデザインしていただきます。マークアップもできる方が良いです。',
                    $jobRepo->findByName('Webデザイナー')->jobId()->code(),
                    1,
                    false
                ),
                new WantedRoleDto(
                    'キャラクター絵師',
                    'RPG風のアプリにする予定です。ジョブにキャラクターの立ち絵を使いたいのでファンタジーなキャラが書ける人を募集しています。',
                    $jobRepo->findByName('ゲームグラフィッカー')->jobId()->code(),
                    4,
                    false
                ),
            ]
        );

        $manager = \App\Infrastracture\AuthData\AuthData::first()->guildMemberEntity();
        $partyServiceFacade->registerParty($manager->studentNumber()->code(), $partyDto);
    }
}
