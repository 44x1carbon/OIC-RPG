<?php

use App\Domain\Course\Course;
use App\Domain\GuildMember\Factory\GuildMemberFactory;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\GuildMember\Spec\GuildMemberSpec;
use App\Domain\GuildMember\ValueObjects\Gender;
use App\Domain\GuildMember\ValueObjects\LoginInfo;
use App\Domain\GuildMember\ValueObjects\MailAddress;
use App\Domain\GuildMember\ValueObjects\PassWord;
use App\Domain\GuildMember\ValueObjects\StudentNumber;
use Tests\Sampler;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/10/27
 * Time: 15:32
 */

class LoginInfoTest extends \Tests\TestCase
{
    use Sampler;

    /* @var GuildMemberRepositoryInterface $repo */
    protected $repo;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->repo = app(GuildMemberRepositoryInterface::class);

        $guildMember = $this->sampleGuildMember(['studentNumber' => 'B4000', 'mailAddress' => 'B4000@oic.jp', 'password' => 'Abcdefg1']);
        $this->repo->save($guildMember);
    }


    function testSuccess()
    {
        $mailAddress = new MailAddress('B4000@oic.jp');
        $passWord = new PassWord('Abcdefg1');
        $loginInfo = new LoginInfo($mailAddress, $passWord);
        $this->assertTrue($this->repo->findByLoginInfo($loginInfo) != null);
    }


    function testFail()
    {
        $mailAddress = new MailAddress('b3000@oic.jp');
        $passWord = new PassWord('Abcdefg1');
        $loginInfo = new LoginInfo($mailAddress, $passWord);
        $this->assertTrue($this->repo->findByLoginInfo($loginInfo) == null);
    }
}
