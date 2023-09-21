<?php

declare(strict_types=1);

namespace App\Modules\Articles\Repositories;

use App\Modules\Articles\Models\Article;
use App\Modules\Articles\Contracts\ArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Elastic\Elasticsearch\Client as Elasticsearch;
use Illuminate\Pagination\LengthAwarePaginator as PaginationLengthAwarePaginator;
use Illuminate\Support\Arr;

class ArticleElasticsearchRepository implements ArticleRepository
{
    public function __construct(
        private Elasticsearch $elasticsearch
    ) {
        
    }

    /**
     * Search articles by query string and return them.
     *
     * @param string|null $query
     * @param int $page
     * @param int $perPage
     * @return Collection|LengthAwarePaginator
     */
    public function search(
        ?string $query = null,
        int $page = 1,
        int $perPage = 15
    ): Collection|LengthAwarePaginator {
        if (is_null($query)) {
            return app()
                ->make(ArticleEloquentRepository::class)
                ->search(page: $page, perPage: $perPage);
        }
        $items = $this->searchInElasticsearch($query, $page, $perPage);
        return $this->buildPaginator($items, $page, $perPage);
    }

    /**
     * Search articles by query string in Elasticsearch.
     *
     * @param string $query
     * @param int $page
     * @param int $perPage
     * @return mixed
     */
    private function searchInElasticsearch(string $query = '', int $page, int $perPage): mixed
    {
        $from = $page * $perPage - $perPage;
        $size = $perPage;

        $model = new Article;
        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'from' => $from,
            'size' => $size,
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5', 'body', 'tags'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);
        return $items;
    }

    /**
     * Build laravel collection from Elasticsearch items.
     *
     * @param mixed $items
     * @return Collection
     */
    private function buildCollection(mixed $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');
        return Article::findMany($ids)
            ->sortBy(function ($article) use ($ids) {
                return array_search($article->getKey(), $ids);
            });
    }

    /**
     * Build laravel collection from Elasticsearch items.
     *
     * @param mixed $items
     * @param int $page
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    private function buildPaginator(mixed $items, int $page, int $perPage): LengthAwarePaginator
    {
        $total = $items['hits']['total']['value'] ?? 0;
        return new PaginationLengthAwarePaginator(
            $this->buildCollection($items),
            $total, $perPage, $page, [
                'path' => request()->fullUrlWithoutQuery('page')
            ]
        );
    }
}
