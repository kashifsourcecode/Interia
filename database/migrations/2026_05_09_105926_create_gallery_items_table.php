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
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_section_id')->constrained()->cascadeOnDelete();
            $table->string('shape_key', 64);
            $table->string('image_path');
            $table->string('image_alt')->nullable();
            $table->boolean('tone_muted')->default(false);
            $table->timestamps();

            $table->unique(['gallery_section_id', 'shape_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};
