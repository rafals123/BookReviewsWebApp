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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('bookTitle');
            $table->string('authorName');
            $table->string('authorSurname');
            $table->integer('releaseDate')->unsigned;
            $table->string('genre');
            $table->bigInteger('numOfRecommended')->unsigned;
            $table->bigInteger('numOfNotRecommended')->unsigned;
            $table->bigInteger('ratingSum')->unsigned();
            $table->bigInteger('ratingCounter')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
