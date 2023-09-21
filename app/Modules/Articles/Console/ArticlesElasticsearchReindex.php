<?php

declare(strict_types=1);

namespace App\Modules\Articles\Console;

use App\Modules\Articles\Models\Article;
use Illuminate\Console\Command;
use Elastic\Elasticsearch\Client as Elasticsearch;

class ArticlesElasticsearchReindex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:reindex:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindex articles in Elasticsearch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        private Elasticsearch $elasticsearch
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Indexing all articles. This might take a while...');

        foreach (Article::cursor() as $article)
        {
            $this->elasticsearch->index([
                'index' => $article->getSearchIndex(),
                'type' => $article->getSearchType(),
                'id' => $article->getKey(),
                'body' => $article->toSearchArray(),
            ]);
            $this->output->write('.');
        }

        $this->info(PHP_EOL . 'Done!');
    }
}
