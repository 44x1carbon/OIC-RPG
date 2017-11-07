<?php

namespace App\Providers;

use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\MemberRecruitment\RepositoryInterface\MemberRecruitmentRepositoryInterface;
use App\Domain\ProductionIdea\RepositoryInterface\ProductionIdeaRepositoryInterface;
use App\Domain\ProductionType\RepositoryInterface\ProductionTypeRepositoryInterface;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Infrastracture\Course\CourseEloquentRepositoryImpl;
use App\Domain\Skill\RepositoryInterface\SkillRepositoryInterface;
use App\Infrastracture\Course\CourseOnMemoryRepositoryImpl;
use App\Infrastracture\MemberRecruitment\MemberRecruitmentOnMemoryRepositoryImpl;
use App\Infrastracture\ProductionIdea\ProductionIdeaOnMemoryRepositoryImpl;
use App\Infrastracture\ProductionType\ProductionTypeOnMemoryRepositoryImpl;
use App\Infrastracture\GuildMember\GuildMemberEloquentRepositoryImpl;
use App\Infrastracture\GuildMember\GuildMemberOnMemoryRepositoryImpl;
use App\Infrastracture\Skill\SkillOnMemoryRepositoryImpl;

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
        $this->app->singleton(MemberRecruitmentRepositoryInterface::class, MemberRecruitmentOnMemoryRepositoryImpl::class);
//        $this->app->singleton(CourseRepositoryInterface::class, CourseOnMemoryRepositoryImpl::class);
        $this->app->singleton(CourseRepositoryInterface::class, CourseEloquentRepositoryImpl::class);
//        $this->app->singleton(GuildMemberRepositoryInterface::class,GuildMemberOnMemoryRepositoryImpl::class);
        $this->app->singleton(GuildMemberRepositoryInterface::class,GuildMemberEloquentRepositoryImpl::class);
        $this->app->singleton(SkillRepositoryInterface::class, SkillOnMemoryRepositoryImpl::class);
    }
}
