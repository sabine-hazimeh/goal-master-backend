<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            GoalSeeder::class,
            FinanceGoalSeeder::class,
            HealthGoalSeeder::class,
            EducationGoalSeeder::class,
            ChatSeeder::class,
            MessageSeeder::class,
            EmotionsSeeder::class,
            JournalsSeeder::class,
            CourseraSeeder::class
        ]);   
    }
}
