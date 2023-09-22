<?php

declare(strict_types=1);

namespace App\Common\Traits\Models;

trait HasElasticsearch
{
    /**
     * Register Elasticsearch observer for the model.
     *
     * @return void
     */
    public static function bootHasElasticsearch()
    {
        if (config('services.elasticsearch.enabled')) {
            static::observe(static::getSearchObserver());
        }
    }

    /**
     * Return Elasticsearch observer class for the model.
     *
     * @return string
     */
    public static function getSearchObserver(): string
    {
        throw new \Exception("Please set Elasticsearch observer in model.");
    }

    /**
     * Return Elasticsearch index name for the model.
     *
     * @return string
     */
    public function getSearchIndex(): string
    {
        return $this->getTable();
    }

    /**
     * Return Elasticsearch search type for the model.
     *
     * @return string
     */
    public function getSearchType(): string
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable();
    }

    /**
     * Transform model to Elasticsearch array.
     *
     * @return array
     */
    public function toSearchArray(): array
    {
        return $this->toArray();
    }
}
