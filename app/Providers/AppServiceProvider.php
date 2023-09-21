<?php

namespace App\Providers;

use App\Modules\Articles\Contracts\ArticleRepository;
use App\Modules\Articles\Repositories\ArticleElasticsearchRepository;
use App\Modules\Articles\Repositories\ArticleEloquentRepository;
use Illuminate\Support\ServiceProvider;
use Elastic\Elasticsearch\Client as Elasticsearch;
use Elastic\Elasticsearch\ClientBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            Elasticsearch::class,
            function ($app) {
                return ClientBuilder::create()
                    ->setHosts($app['config']->get('services.elasticsearch.hosts'))
                    ->build();
            }
        );

        $this->app->bind(
            ArticleRepository::class,
            function () {
                if (! config('services.elasticsearch.enabled')) {
                    return new ArticleEloquentRepository;
                }
                return new ArticleElasticsearchRepository(
                    $this->app->make(Elasticsearch::class)
                );
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
