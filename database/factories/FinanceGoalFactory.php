<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FinanceGoal;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FinanceGoal>
 */
class FinanceGoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'income' => $this->faker->numberBetween(1000, 5000),
            'savings' => $this->faker->numberBetween(100, 1000),
            'expenses' => $this->faker->numberBetween(500, 4500),
            'target' => $this->faker->numberBetween(10000, 50000),
            'target_date' => $this->faker->date(),
            'goal_id' => Goal::inRandomOrder()->first()->id,

        ];
    }
}
