<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EducationGoal;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coursera>
 */
class CourseraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(5),
            'hours' => $this->faker->numberBetween(1, 100),
            'level' => $this->faker->randomElement(['Beginner level', 'Intermediate level', 'Advanced level']),
            'url' => $this->faker->url(),
            'education_id' => EducationGoal::inRandomOrder()->first()->id,

        ];
    }
}
