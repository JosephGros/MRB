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
        Schema::create('watchlists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Watchlist');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('media_id');
            $table->string('media_type');
            $table->timestamps();
            $table->index('user_id');
            $table->index(['media_id', 'media_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watchlists');
    }
};
