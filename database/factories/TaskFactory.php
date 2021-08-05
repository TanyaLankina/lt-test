<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Task;
use Carbon\Carbon;
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
        $now = Carbon::now();

        return [
            'title' => $this->faker->text(100),
            'description' => $this->faker->text(),
            'category_id' => function () {
                return Category::all()->random()->id;
            },
            'created_at' => $now,
            'updated_at' => $now
        ];
    }
}
