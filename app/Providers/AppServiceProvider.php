<?php

namespace App\Providers;

use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\Field\FieldRepositoryInterface;
use App\Domain\GuildMember\GuildMember;
use App\Domain\Job\JobRepositoryInterface;
use App\Domain\Notification\RepositoryInterface\NotificationRepositoryInterface;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyParticipationRequest\RepositoryInterface\PartyParticipationRequestRepositoryInterface;
use App\Domain\PartyWrittenRequest\RepositoryInterface\PartyWrittenRequestRepositoryInterface;
use App\Domain\Scout\ScoutRepositoryInterface;
use App\Domain\WantedMember\RepositoryInterface\WantedMemberRepositoryInterface;
use App\Domain\ProductionIdea\RepositoryInterface\ProductionIdeaRepositoryInterface;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Eloquents\PossessionSkillEloquent;
use App\Domain\WantedRole\RepositoryInterface\WantedRoleRepositoryInterface;
use App\Infrastracture\AuthData\AuthData;
use App\Infrastracture\Course\CourseEloquentRepositoryImpl;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Infrastracture\Course\CourseOnMemoryRepositoryImpl;
use App\Infrastracture\Field\FieldEloquentRepositoryImpl;
use App\Infrastracture\Job\JobEloquentRepositoryImpl;
use App\Infrastracture\Notification\NotificationEloquentRepositoryImpl;
use App\Infrastracture\Party\PartyEloquentRepositoryImpl;
use App\Infrastracture\Party\PartyOnMemoryRepositoryImpl;
use App\Infrastracture\PartyParticipationRequest\PartyParticipationRequestEloquentRepositoryImpl;
use App\Infrastracture\PartyWrittenRequest\PartyWrittenRequestOnMemoryRepositoryImpl;
use App\Infrastracture\Scout\ScoutEloquentRepositoryImpl;
use App\Infrastracture\Skill\SkillEloquentRepositoryImpl;
use App\Infrastracture\ProductionIdea\ProductionIdeaEloquentRepositoryImpl;
use App\Infrastracture\ProductionType\ProductionTypeEloquentRepositoryImpl;
use App\Infrastracture\WantedMember\WantedMemberEloquentRepositoryImpl;
use App\Infrastracture\WantedMember\WantedMemberOnMemoryRepositoryImpl;
use App\Infrastracture\ProductionIdea\ProductionIdeaOnMemoryRepositoryImpl;
use App\Infrastracture\ProductionType\ProductionTypeOnMemoryRepositoryImpl;
use App\Infrastracture\GuildMember\GuildMemberEloquentRepositoryImpl;
use App\Infrastracture\GuildMember\GuildMemberOnMemoryRepositoryImpl;
use App\Infrastracture\Skill\SkillOnMemoryRepositoryImpl;
use App\Domain\PossessionSkill\RepositoryInterface\PossessionSkillRepositoryInterface;
use App\Infrastracture\WantedRole\WantedRoleEloquentRepositoryImpl;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Infrastracture\WantedRole\WantedRoleOnMemoryRepositoryImpl;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if(env('REDIRECT_HTTPS'))
        {
            URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $monolog = Log::getMonolog();
        $monolog->pushHandler(new \Monolog\Handler\StreamHandler('php://stderr'));

//        $this->app->singleton(ProductionTypeRepositoryInterface::class, ProductionTypeOnMemoryRepositoryImpl::class);
        $this->app->singleton(ProductionTypeRepositoryInterface::class, ProductionTypeEloquentRepositoryImpl::class);
//        $this->app->singleton(ProductionIdeaRepositoryInterface::class, ProductionIdeaOnMemoryRepositoryImpl::class);
        $this->app->singleton(ProductionIdeaRepositoryInterface::class, ProductionIdeaEloquentRepositoryImpl::class);
//        $this->app->singleton(WantedMemberRepositoryInterface::class, WantedMemberOnMemoryRepositoryImpl::class);
        $this->app->singleton(WantedMemberRepositoryInterface::class, WantedMemberEloquentRepositoryImpl::class);
//        $this->app->singleton(WantedRoleRepositoryInterface::class, WantedRoleOnMemoryRepositoryImpl::class);
        $this->app->singleton(WantedRoleRepositoryInterface::class, WantedRoleEloquentRepositoryImpl::class);
//        $this->app->singleton(CourseRepositoryInterface::class, CourseOnMemoryRepositoryImpl::class);
        $this->app->singleton(CourseRepositoryInterface::class, CourseEloquentRepositoryImpl::class);
//        $this->app->singleton(GuildMemberRepositoryInterface::class,GuildMemberOnMemoryRepositoryImpl::class);
        $this->app->singleton(GuildMemberRepositoryInterface::class,GuildMemberEloquentRepositoryImpl::class);
//        $this->app->singleton(SkillRepositoryInterface::class, SkillOnMemoryRepositoryImpl::class);
        $this->app->singleton(SkillRepositoryInterface::class, SkillEloquentRepositoryImpl::class);
        $this->app->singleton(PartyRepositoryInterface::class, PartyOnMemoryRepositoryImpl::class);
//        $this->app->singleton(PartyRepositoryInterface::class, PartyOnMemoryRepositoryImpl::class);
        $this->app->singleton(PartyRepositoryInterface::class, PartyEloquentRepositoryImpl::class);
        $this->app->singleton(PartyParticipationRequestRepositoryInterface::class, PartyParticipationRequestEloquentRepositoryImpl::class);
        $this->app->singleton(PartyWrittenRequestRepositoryInterface::class, PartyWrittenRequestOnMemoryRepositoryImpl::class);
        $this->app->bind(GuildMember::class, function(): ?GuildMember
        {

            if(Auth::check()) return AuthData::where([
                'email' => Auth::user()->email,
                'password' => Auth::user()->password,
            ])->firstOrFail()->guildMemberEntity();
            if(env('APP_ENV', 'local') === 'local') return AuthData::firstOrFail()->guildMemberEntity();
            return null;
        });
        $this->app->singleton(JobRepositoryInterface::class, JobEloquentRepositoryImpl::class);
        $this->app->singleton(FieldRepositoryInterface::class, FieldEloquentRepositoryImpl::class);
        $this->app->singleton(ScoutRepositoryInterface::class, ScoutEloquentRepositoryImpl::class);
        $this->app->singleton(NotificationRepositoryInterface::class, NotificationEloquentRepositoryImpl::class);
    }
}
