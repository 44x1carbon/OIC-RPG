<?php

namespace App\Providers;

use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\Party\RepositoryInterface\PartyRepositoryInterface;
use App\Domain\PartyWrittenRequest\RepositoryInterface\PartyWrittenRequestRepositoryInterface;
use App\Domain\WantedMember\RepositoryInterface\WantedMemberRepositoryInterface;
use App\Domain\ProductionIdea\RepositoryInterface\ProductionIdeaRepositoryInterface;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Domain\WantedRole\RepositoryInterface\WantedRoleRepositoryInterface;
use App\Infrastracture\Course\CourseEloquentRepositoryImpl;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Infrastracture\Course\CourseOnMemoryRepositoryImpl;
use App\Infrastracture\Party\PartyOnMemoryRepositoryImpl;
use App\Infrastracture\PartyWrittenRequest\PartyWrittenRequestOnMemoryRepositoryImpl;
use App\Infrastracture\WantedMember\WantedMemberOnMemoryRepositoryImpl;
use App\Infrastracture\ProductionIdea\ProductionIdeaOnMemoryRepositoryImpl;
use App\Infrastracture\ProductionType\ProductionTypeOnMemoryRepositoryImpl;
use App\Infrastracture\GuildMember\GuildMemberEloquentRepositoryImpl;
use App\Infrastracture\GuildMember\GuildMemberOnMemoryRepositoryImpl;
use App\Infrastracture\Skill\SkillOnMemoryRepositoryImpl;
use App\Infrastracture\WantedRole\WantedRoleOnMemoryRepositoryImpl;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(ProductionTypeRepositoryInterface::class, ProductionTypeOnMemoryRepositoryImpl::class);
        $this->app->singleton(ProductionIdeaRepositoryInterface::class, ProductionIdeaOnMemoryRepositoryImpl::class);
        $this->app->singleton(WantedMemberRepositoryInterface::class, WantedMemberOnMemoryRepositoryImpl::class);
        $this->app->singleton(WantedRoleRepositoryInterface::class, WantedRoleOnMemoryRepositoryImpl::class);
//        $this->app->singleton(CourseRepositoryInterface::class, CourseOnMemoryRepositoryImpl::class);
        $this->app->singleton(CourseRepositoryInterface::class, CourseEloquentRepositoryImpl::class);
//        $this->app->singleton(GuildMemberRepositoryInterface::class,GuildMemberOnMemoryRepositoryImpl::class);
        $this->app->singleton(GuildMemberRepositoryInterface::class,GuildMemberEloquentRepositoryImpl::class);
        $this->app->singleton(SkillRepositoryInterface::class, SkillOnMemoryRepositoryImpl::class);
        $this->app->singleton(PartyRepositoryInterface::class, PartyOnMemoryRepositoryImpl::class);
        $this->app->singleton(PartyWrittenRequestRepositoryInterface::class, PartyWrittenRequestOnMemoryRepositoryImpl::class);
    }
}
