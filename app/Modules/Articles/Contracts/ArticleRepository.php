<?php

declare(strict_types=1);

namespace App\Modules\Articles\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ArticleRepository
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
    ): Collection|LengthAwarePaginator;
}
