<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_ingredients', function (Blueprint $table) {
            $table->id();

            $table->string('brand')->nullable();
            $table->tinyText('category')->nullable();
            $table->tinyText('sub_category')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');

            $table->unique(['ingredient_id', 'brand']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_ingredients');
    }
};
