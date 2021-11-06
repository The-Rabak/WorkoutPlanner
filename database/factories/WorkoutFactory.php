<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->sentence(),
            "description" => $this->faker->paragraph(),
            "created_by_user_id" => function()
            {
                return auth()->id() ?? User::factory()->create()->id;
            },
            "url" => $this->faker->url()
        ];
    }
}
