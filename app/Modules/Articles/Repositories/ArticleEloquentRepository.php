<?php

declare(strict_types=1);

namespace App\Modules\Articles\Repositories;

use App\Common\Repositories\BaseRepository;
use App\Modules\Articles\Models\Article;
use App\Modules\Articles\Contracts\ArticleRepository;

class ArticleEloquentRepository extends BaseRepository implements ArticleRepository
{
    /**
     * Set query builder by search string and return repository object.
     *
     * @param string|null $query
     * @return ArticleRepository
     */
    public function search(?string $query = null): ArticleRepository {
        return $this->setQueryBulder(
            Article::query()
            ->when(!is_null($query), fn ($builder) =>
                $builder->where('body', 'like', "%{$query}%")
                    ->orWhere('title', 'like', "%{$query}%")
            )
        );
    }
}
