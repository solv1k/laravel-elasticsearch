<?php

namespace App\Modules\Articles\Models;

use App\Common\Models\BaseModel;
use App\Modules\Articles\Database\Factories\ArticleCategoryFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ArticleCategory extends BaseModel implements Sortable
{
    use HasFactory, SortableTrait;

    /**
     * Return factory for model.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return new ArticleCategoryFactory;
    }

    /**
     * All articles from category (relation).
     *
     * @return HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
