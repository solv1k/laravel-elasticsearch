<?php

declare(strict_types=1);

namespace App\Common\Traits\Models;

trait HasElasticsearch
{
    public static function bootHasElasticsearch()
    {
        if (config('services.elasticsearch.enabled')) {
            static::observe(static::getSearchObserver());
        }
    }
    public static function getSearchObserver()
    {
        throw new \Exception("Please set Elasticsearch observer in model.");
    }
    public function getSearchIndex()
    {
        return $this->getTable();
    }
    public function getSearchType()
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable();
    }
    public function toSearchArray()
    {
        return $this->toArray();
    }
}
