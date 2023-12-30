<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->integer('exercise_id');
            $table->foreign('exercise_id')->references('id')->on('exercises');
            $table->integer('repetitions');
            $table->decimal('weight', 5, 2);
            $table->integer('break_time');
            $table->enum('day', ['SEGUNDA', 'TERCA', 'QUARTA', 'QUINTA', 'SEXTA', 'SABADO', 'DOMINGO']);
            $table->text('observations')->nullable();
            $table->integer('time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};
