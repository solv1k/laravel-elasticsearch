<?php

declare(strict_types=1);

namespace App\Modules\Articles\Observers;

use App\Modules\Articles\Models\Article;
use Elastic\Elasticsearch\Client as Elasticsearch;

class ArticleElasticsearchObserver
{
    public function __construct(
        private Elasticsearch $elasticsearch
    ) {

    }

    public function created(Article $model): void
    {
        $this->elasticsearch->index([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
            'body' => $model->toSearchArray(),
        ]);
    }

    public function deleted(Article $model): void
    {
        $this->elasticsearch->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey()
        ]);
    }
}
