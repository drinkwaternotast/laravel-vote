<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\PhotosRepositoryInterface', 'App\Repositories\PhotosRepository');
        $this->app->bind('App\Repositories\FavoritesRepositoryInterface', 'App\Repositories\FavoritesRepository');
        $this->app->bind('App\Repositories\FansRepositoryInterface', 'App\Repositories\FansRepository');
        $this->app->bind('App\Repositories\BattlesRepositoryInterface', 'App\Repositories\BattlesRepository');
        $this->app->bind('App\Repositories\VotesRepositoryInterface', 'App\Repositories\VotesRepository');
        $this->app->bind('App\Repositories\ProfilesRepositoryInterface', 'App\Repositories\ProfilesRepository');
        $this->app->bind('App\Repositories\StagesRepositoryInterface', 'App\Repositories\StagesRepository');
        $this->app->bind('App\Repositories\RankingsRepositoryInterface', 'App\Repositories\RankingsRepository');
        $this->app->bind('App\Repositories\VoteCountersRepositoryInterface', 'App\Repositories\VoteCountersRepository');
        $this->app->bind('App\Repositories\TagsRepositoryInterface', 'App\Repositories\TagsRepository');
    }
}
