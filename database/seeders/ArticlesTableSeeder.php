<?php

namespace Database\Seeders;

use App\Modules\Articles\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /** Count articles for create in seeder. */
    public const ARTICLE_COUNT = 500;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(Article::getTableName())->truncate();
        Article::factory(static::ARTICLE_COUNT)->create();
    }
}
