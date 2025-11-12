<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'in-progress', 'completed']),
            'due_date' => $this->faker->optional()->date(),
        ];
    }
}
