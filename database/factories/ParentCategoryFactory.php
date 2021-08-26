<?php

namespace Database\Factories;

use App\Models\ParentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParentCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ParentCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text_jp' => $this->faker->realText(50),
            'sort_number' => $this->faker->unique()->numberBetween(1, 10000),
        ];
    }
}
