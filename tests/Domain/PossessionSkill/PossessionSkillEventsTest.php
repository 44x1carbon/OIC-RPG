<?php

use App\Domain\Course\Course;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use App\Domain\PossessionSkill\Factory\PossessionSkillFactory;
use App\Domain\PossessionSkill\PossessionSkill;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Domain\PossessionSkill\Service\PossessionSkillDomainService;
use App\Domain\Skill\Factory\SkillFactory;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Domain\Skill\Skill;
use App\Events\AddExpEvent;
use App\Events\LevelUpEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Testing\Fakes\EventFake;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/11/10
 * Time: 14:35
 */


class PossessionSkillEventsTest extends \Tests\TestCase
{
    protected $possessionSkillRepo;

    function testAddExpEvent()
    {
        $skillFactory = new SkillFactory();
        $skill = $skillFactory->createSkill('php');

        $possessionSkillFactory = new PossessionSkillFactory();
        $possessionSkill = $possessionSkillFactory->possessSkill($skill);

        $this->possessionSkillRepo = app(PossessionSkillRepositoryInterface::class);
        $this->possessionSkillRepo->save($possessionSkill);

        Event::fake();

        $eventFake = new EventFake();

        $eventFake->assertDispatched(AddExpEvent::class, function ($e) use($possessionSkill){
            return $e->possessionSkill->skill()->skillId() === $possessionSkill->skill()->skillId();
        });
    }

    function testLevelUpEvent()
    {
        Event::fake();

        $eventFake = new EventFake();

        $eventFake->assertDispatched(LevelUpEvent::class);
    }
}
