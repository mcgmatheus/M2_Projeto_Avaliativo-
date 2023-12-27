<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remover a restrição única existente
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_email_unique');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->string('email', 255)->unique()->change();
            $table->date('date_birth');
            $table->string('cpf', 14)->unique();
            $table->string('password', 255)->change();
            $table->integer('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->string('email', 255)->unique();
            $table->dropColumn(['date_birth', 'cpf', 'password', 'plan_id']);
        });
    }
};