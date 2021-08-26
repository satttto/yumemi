<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text_jp' => $this->faker->realText(50),
            'parent_category_id' => ParentCategory::inRandomOrder()->first()->id,
            'sort_number' => $this->faker->unique()->numberBetween(1, 10000),
        ];
    }
}
