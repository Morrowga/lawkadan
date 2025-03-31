<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use App\Repositories\System\User\UserRepository;
use App\Repositories\System\Auth\API\AuthRepository;
use App\Repositories\System\Post\API\PostRepository;
use App\Interfaces\System\User\UserRepositoryInterface;
use App\Repositories\System\Dashboard\DashboardRepository;
use App\Interfaces\System\Auth\API\AuthRepositoryInterface;
use App\Interfaces\System\Post\API\PostRepositoryInterface;
use App\Repositories\System\Category\API\CategoryRepository;
use App\Repositories\System\Location\API\LocationRepository;
use App\Interfaces\System\Dashboard\DashboardRepositoryInterface;
use App\Interfaces\System\Category\API\CategoryRepositoryInterface;
use App\Interfaces\System\Location\API\LocationRepositoryInterface;
use App\Repositories\System\Announcement\API\AnnouncementRepository;
use App\Repositories\System\DisasterData\API\DisasterDataRepository;
use App\Interfaces\System\Announcement\API\AnnouncementRepositoryInterface;
use App\Interfaces\System\DisasterData\API\DisasterDataRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
public function register(): void
    {
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        //api
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(AnnouncementRepositoryInterface::class, AnnouncementRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
