<?php

declare(strict_types=1);

namespace App\Common\Contracts\Repositories;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface BaseRepository
{
    /**
     * Set repository query builder.
     *
     * @param Builder $builder
     * @return static
     */
    public function setQueryBulder(Builder $builder): static;

    /**
     * Return repository query builder.
     *
     * @return Builder
     */
    public function getQueryBuilder(): Builder;

    /**
     * Execute repository query and return data wrapped in laravel collection.
     *
     * @return Collection
     */
    public function exec(): Collection;

    /**
     * Execute repository query and return data with pagination.
     *
     * @param int $page
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $page = 1, int $perPage = 15): LengthAwarePaginator;
}
