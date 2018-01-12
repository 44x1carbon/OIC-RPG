<?php

use Illuminate\Database\Seeder;

class GuildMemberSeeder extends Seeder
{
    use \Tests\Sampler;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guildMemberRepo = app(\App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface::class);
        $fieldRepo = app(\App\Domain\Field\FieldRepositoryInterface::class);
        for($i = 0; $i < 10; $i++) {
            $guildMember = $this->sampleGuildMember();
            /* @var \App\Domain\Field\Field $field */
            $field = $fieldRepo->findByCourseId($guildMember->course()->id());
            $guildMember->setFavoriteJob($field->defaultJob()->jobId());
            $guildMemberRepo->save($guildMember);
        }
    }
}