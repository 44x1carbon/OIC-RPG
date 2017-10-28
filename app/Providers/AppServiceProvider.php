<?php

namespace App\Providers;

use App\Domain\Course\RepositoryInterface\CourseRepositoryInterface;
use App\Domain\GuildMember\RepositoryInterface\GuildMemberRepositoryInterface;
use App\Infrastracture\Course\CourseEloquentRepositoryImpl;
use App\Infrastracture\Course\CourseOnMemoryRepositoryImpl;
use App\Infrastracture\GuildMember\GuildMemberEloquentRepositoryImpl;
use App\Infrastracture\GuildMember\GuildMemberOnMemoryRepositoryImpl;
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
//        $this->app->singleton(CourseRepositoryInterface::class, CourseOnMemoryRepositoryImpl::class);
        $this->app->singleton(CourseRepositoryInterface::class, CourseEloquentRepositoryImpl::class);
//        $this->app->singleton(GuildMemberRepositoryInterface::class,GuildMemberOnMemoryRepositoryImpl::class);
        $this->app->singleton(GuildMemberRepositoryInterface::class,GuildMemberEloquentRepositoryImpl::class);
    }
}
