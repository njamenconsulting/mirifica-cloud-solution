<?php

namespace App\Providers;

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
        $this->app->bind(SqliteRepositoryInterface::class, BaseRepository::class);
       // $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);

        $this->app->when(PlentymarketArticleController::class)
                    ->needs(ArticleRepositoryInterface::class)
                    ->give(function () {
                        return ArticleRepository::class($plentymarkets);
                    });
 
        $this->app->when([TrenzArticleController::class])
                ->needs(ArticleRepositoryInterface::class)
                ->give(function () {
                    return ArticleRepository::class($trenzs);
                });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
