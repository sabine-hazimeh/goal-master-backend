<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Chat;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           "chat_id" => Chat::inRandomOrder()->first()->id,
           "sender_id" => User::inRandomOrder()->first()->id,
           "content" => $this->faker->sentence(),
        ];
    }
}
