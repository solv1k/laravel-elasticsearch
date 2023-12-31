<?php

declare(strict_types=1);

namespace App\Modules\Articles\Database\Factories;

use App\Modules\Articles\Models\Article;
use App\Modules\Articles\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Articles\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tags = collect(['php', 'ruby', 'java', 'javascript', 'c#', 'bash', 'golang', 'rust'])
            ->random(3)
            ->values()
            ->all();

        return [
            'title' => fake()->sentence(),
            'body' => fake()->text(),
            'tags' => $tags,
            'category_id' => ArticleCategory::inRandomOrder()->first()->id
        ];
    }
}
