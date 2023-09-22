<?php

declare(strict_types=1);

namespace App\Modules\Articles\Models;

use App\Common\Models\BaseModel;
use App\Common\Traits\Models\HasElasticsearch;
use App\Modules\Articles\Database\Factories\ArticleFactory;
use App\Modules\Articles\Observers\ArticleElasticsearchObserver;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends BaseModel
{
    use HasFactory, HasElasticsearch;

    protected $casts = [
        'tags' => 'json',
    ];

    /**
     * Return factory for the model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return new ArticleFactory;
    }

    /**
     * Return Elasticsearch observer class for the model.
     *
     * @return string
     */
    public static function getSearchObserver(): string
    {
        return ArticleElasticsearchObserver::class;
    }

    /**
     * Category (relation).
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
