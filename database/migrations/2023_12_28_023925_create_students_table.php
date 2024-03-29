<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->date('date_birth');
            $table->string('cpf', 14)->unique();
            $table->string('contact', 20);
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('city', 50)->nullable();
            $table->string('neighborhood', 50)->nullable();
            $table->string('number', 30)->nullable();
            $table->string('street', 30)->nullable();
            $table->string('state', 2)->nullable();
            $table->string('cep', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};