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
        Schema::create('user_list_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_lists_id')->constrained()->onDelete('cascade');
            $table->foreignId('media_id');
            $table->string('media_type');
            $table->timestamps();

            $table->index('user_lists_id');
            $table->index(['media_id', 'media_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_list_contents');
    }
};
