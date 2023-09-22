<?php

declare(strict_types=1);

namespace App\Modules\Articles\Contracts;

use App\Common\Contracts\Repositories\BaseRepository;

interface ArticleRepository extends BaseRepository
{
    /**
     * Set query builder by search string and return repository object.
     *
     * @param string|null $query
     * @return ArticleRepository
     */
    public function search(?string $query = null): ArticleRepository;
}
