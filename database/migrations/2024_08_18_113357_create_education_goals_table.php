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
        Schema::create('education_goals', function (Blueprint $table) {
            $table->id();
            $table->string('goal');
            $table->string('current_knowledge');
            $table->integer('available_days');
            $table->integer('available_hours');
            $table->date('time_horizon');
            $table->unsignedBigInteger('goal_id');
            $table->foreign('goal_id')->references('id')->on('goals')->onDelete('cascade')->onUpdate("cascade");
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_goals');
    }
};
