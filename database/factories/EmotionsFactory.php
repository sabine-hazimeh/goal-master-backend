<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Emotions>
 */
class EmotionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "type" => $this->faker->randomElement(['manual','detected']),
            "emotion" => $this->faker->randomElement(['sad','happy','angry','surprised','disgusted','confused','scared','shy','bored']),
        ];
    }
}
