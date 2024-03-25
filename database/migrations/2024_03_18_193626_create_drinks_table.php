<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drinks', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->text('notes')->nullable();
            $table->boolean('published')->default(false);
            $table->integer('save_count')->default(0);
            $table->tinyInteger('serves')->default(1);
            $table->text('directions')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drinks');
    }
};
