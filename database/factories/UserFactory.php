<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $role = $this->faker->randomElement(['user', 'consultant']);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role' => $role,
            'profile_photo' => $this->faker->optional()->imageUrl(),
            'phone_number' => $role === 'consultant' ? $this->faker->phoneNumber() : null,
            'description' => $role === 'consultant' ? $this->faker->sentence() : null,
            'experience' => $role === 'consultant' ? $this->faker->numberBetween(1, 30) : null,
            'remember_token' => Str::random(10),
        ];
    }
}
