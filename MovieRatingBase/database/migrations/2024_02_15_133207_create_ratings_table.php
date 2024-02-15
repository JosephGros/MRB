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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('movie_id')->constrained()->nullable()->onDelete('cascade');
            $table->foreignId('serie_id')->constrained()->nullable()->onDelete('cascade');
            $table->foreignId('episode_id')->constrained()->nullable()->onDelete('cascade');

            $table->index(['movie_id', 'serie_id', 'episode_id']);
            $table->where(function ($query){
                $query->whereNotNull('movie_id');
                $query->orWhereNotNull('serie_id');
                $query->orWhereNotNull('episode_id');
            });
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
