<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('health_goals', function (Blueprint $table) {
            $table->id();
            $table->integer('age');
            $table->enum('gender', ['male', 'female']);
            $table->decimal('height', 5, 2);
            $table->decimal('current_weight', 5, 2);
            $table->decimal('desired_weight', 5, 2);
            $table->string('medical_conditions');
            $table->date('time_horizon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_goals');
    }
};
