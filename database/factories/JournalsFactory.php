<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Emotions;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Journals>
 */
class JournalsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "mood"=>$this->faker->randomElement(['good', 'bad', 'neutral']),
            "productivity"=>$this->faker->numberBetween(0,10),
            "focus"=>$this->faker->numberBetween(0,10),
            "description"=>$this->faker->sentence(),
            "emotion_id"=>Emotions::inRandomOrder()->first()->id,
            "user_id"=>User::inRandomOrder()->first()->id,
        ];
    }
}
