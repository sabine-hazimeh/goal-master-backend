<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Goal;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EducationGoal>
 */
class EducationGoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'goal' => $this->faker->sentence(),
            'current_knowledge' => $this->faker->sentence(),
            'available-days' => $this->faker->numberBetween(1, 7),
            'available-hours' => $this->faker->numberBetween(1, 24),
            'time_horizon' => $this->faker->date(),
            'goal_id' => Goal::inRandomOrder()->first()->id,
        ];
        
    }
}
