<?php

declare(strict_types=1);

namespace App\Common\Repositories;

use App\Common\Contracts\Repositories\BaseRepository as BaseRepositoryContract;
use Illuminate\Contracts\Database\Eloquent\Builder as BuilderContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements BaseRepositoryContract
{
    /**
     * Repository query builder.
     *
     * @var BuilderContract|null
     */
    private $queryBuilder = null;

    /**
     * Set repository query builder.
     *
     * @param BuilderContract $builder
     * @return static
     */
    public function setQueryBulder(BuilderContract $builder): static
    {
        $this->queryBuilder = $builder;
        return $this;
    }

    /**
     * Return repository query builder.
     *
     * @return Builder
     */
    public function getQueryBuilder(): Builder
    {
        return $this->queryBuilder;
    }

    /**
     * Execute repository query and return data wrapped in laravel collection.
     *
     * @return Collection
     */
    public function exec(): Collection
    {
        return $this->getQueryBuilder()->get();
    }

    /**
     * Execute repository query and return data with pagination.
     *
     * @param int $page
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $page = 1, int $perPage = 15): LengthAwarePaginator
    {
        return $this->getQueryBuilder()->paginate();
    }
}
