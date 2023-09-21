<?php

declare(strict_types=1);

namespace App\Modules\Articles\Models;

use App\Common\Models\BaseModel;
use App\Common\Traits\Models\HasElasticsearch;
use App\Modules\Articles\Observers\ArticleElasticsearchObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends BaseModel
{
    use HasFactory, HasElasticsearch;

    protected $casts = [
        'tags' => 'json',
    ];

    public static function getSearchObserver()
    {
        return ArticleElasticsearchObserver::class;
    }
}
