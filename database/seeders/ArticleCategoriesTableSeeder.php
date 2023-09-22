<?php

namespace Database\Seeders;

use App\Modules\Articles\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleCategoriesTableSeeder extends Seeder
{
    /** Count article categories for create in seeder. */
    public const ARTICLE_CATEGORY_COUNT = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table(ArticleCategory::getTableName())->truncate();
        ArticleCategory::factory(static::ARTICLE_CATEGORY_COUNT)->create();
    }
}
