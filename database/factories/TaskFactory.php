<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Category;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'level_id' => Level::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'text_jp' => $this->faker->realText(20),
            'description' => $this->faker->realText(100),
            'sort_number' => $this->faker->unique()->numberBetween(1, 10000),
        ];
    }
}
