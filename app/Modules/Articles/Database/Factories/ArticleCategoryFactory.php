<?php

namespace App\Modules\Articles\Database\Factories;

use App\Modules\Articles\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\Articles\Models\ArticleCategory>
 */
class ArticleCategoryFactory extends Factory
{
    protected $model = ArticleCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3)
        ];
    }
}
