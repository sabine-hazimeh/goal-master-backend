<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Goal;
use App\Models\HealthGoal;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HealthGoal>
 */
class HealthGoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'age'=> $this->faker->numberBetween(1, 100),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'height' => $this->faker->numberBetween(1, 200),
            'current_weight' => $this->faker->numberBetween(1, 150),
            'desired_weight' => $this->faker->numberBetween(1, 100),
            'medical_conditions' => $this->faker->sentence(),
            'time_horizon' => $this->faker->date(),
            'goal_id' => Goal::inRandomOrder()->first()->id,

        ];
    }
}
