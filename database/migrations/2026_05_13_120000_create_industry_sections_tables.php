<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('industry_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('label')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('sub_heading');
            $table->text('sub_lead')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('industry_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('industry_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('mosaic_column', 16);
            $table->string('media_position', 16);
            $table->string('aspect_preset', 16)->default('default');
            $table->string('title');
            $table->text('description');
            $table->string('image_path')->nullable();
            $table->string('image_alt')->nullable();
            $table->timestamps();

            $table->index(['industry_section_id', 'mosaic_column', 'sort_order'], 'industry_cards_sec_col_sort_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('industry_cards');
        Schema::dropIfExists('industry_sections');
    }
};
