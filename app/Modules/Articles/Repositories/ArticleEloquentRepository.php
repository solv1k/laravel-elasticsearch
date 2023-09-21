<?php

declare(strict_types=1);

namespace App\Modules\Articles\Repositories;

use App\Modules\Articles\Models\Article;
use App\Modules\Articles\Contracts\ArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticleEloquentRepository implements ArticleRepository
{
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
        return Article::query()
            ->when(!is_null($query), fn ($builder) =>
                $builder->where('body', 'like', "%{$query}%")
                    ->orWhere('title', 'like', "%{$query}%")
            )
            ->paginate(page: $page, perPage: $perPage);
    }
}
