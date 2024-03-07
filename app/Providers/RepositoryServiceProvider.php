<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\LevelRepositoryInterface;
use App\Repositories\Interfaces\PriorityRepositoryInterface;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Repositories\Interfaces\UserProjectRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\UserTaskRepositoryInterface;
use App\Repositories\LevelRepository;
use App\Repositories\PriorityRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserProjectRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserTaskRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(UserRepositoryInterface::class,UserRepository::class);
        $this->app->singleton(ProjectRepositoryInterface::class,ProjectRepository::class);
        $this->app->singleton(UserProjectRepositoryInterface::class,UserProjectRepository::class);
        $this->app->singleton(TaskRepositoryInterface::class,TaskRepository::class);
        $this->app->singleton(UserTaskRepositoryInterface::class,UserTaskRepository::class);
        $this->app->singleton(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->singleton(LevelRepositoryInterface::class,LevelRepository::class);
        $this->app->singleton(PriorityRepositoryInterface::class,PriorityRepository::class);

    }
}
