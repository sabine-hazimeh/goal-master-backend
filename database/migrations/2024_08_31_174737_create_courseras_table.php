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
        Schema::create('courseras', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('hours');
            $table->enum('level', ['Beginner level', 'Intermediate level', 'Advanced level']);
            $table->string('url');
            $table->unsignedBigInteger('education_id');
            $table->foreign('education_id')->references('id')->on('education_goals')->onDelete('cascade')->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courseras');
    }
};
