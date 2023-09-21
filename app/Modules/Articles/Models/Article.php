<?php

declare(strict_types=1);

namespace App\Modules\Articles\Models;

use App\Common\Models\BaseModel;
use App\Common\Traits\Models\HasElasticsearch;
use App\Modules\Articles\Database\Factories\ArticleFactory;
use App\Modules\Articles\Observers\ArticleElasticsearchObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends BaseModel
{
    use HasFactory, HasElasticsearch;

    protected $casts = [
        'tags' => 'json',
    ];

    protected static function newFactory()
    {
        return new ArticleFactory;
    }

    public static function getSearchObserver()
    {
        return ArticleElasticsearchObserver::class;
    }
}
