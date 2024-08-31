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
            'title'->faker->sentence(5),
            'hours'->faker->numberBetween(1, 100),
            'level'->faker->randomElement(['Beginner level', 'Intermediate level', 'Advanced level']),
            'url'->faker->url(),
            'education_id'=> EducationGoal::inRandomOrder()->first()->id,

        ];
    }
}
