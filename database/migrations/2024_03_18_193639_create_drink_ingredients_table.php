<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drink_ingredients', function (Blueprint $table) {
            $table->id();
            $table->tinyText('amount');
            $table->tinyText('amount_unit')->nullable();

            $table->tinyText('brand')->nullable();
            $table->boolean('garnish')->default(false);
            $table->boolean('required')->default(false);

            $table->unsignedBigInteger('drink_id');
            $table->foreign('drink_id')->references('id')->on('drinks');

            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drink_ingredients');
    }
};
