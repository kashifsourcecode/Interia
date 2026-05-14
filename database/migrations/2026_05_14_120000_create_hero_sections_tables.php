<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('badge_text')->nullable();
            $table->string('headline_line_1');
            $table->string('headline_line_2_lead')->nullable();
            $table->string('headline_line_2_accent');
            $table->text('subheadline');
            $table->string('background_mode', 16)->default('video');
            $table->string('background_video_path')->nullable();
            $table->string('background_image_path')->nullable();
            $table->string('primary_cta_label');
            $table->string('primary_cta_url');
            $table->string('primary_cta_icon_path')->nullable();
            $table->string('secondary_cta_label');
            $table->string('secondary_cta_url');
            $table->string('secondary_cta_icon_path')->nullable();
            $table->boolean('secondary_cta_show_arrow')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('hero_trust_chips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hero_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('label');
            $table->timestamps();
        });

        Schema::create('hero_stat_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hero_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('label');
            $table->decimal('count_target', 12, 2)->nullable();
            $table->boolean('count_as_decimal')->default(false);
            $table->string('suffix_after_count')->nullable();
            $table->string('static_display')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_stat_items');
        Schema::dropIfExists('hero_trust_chips');
        Schema::dropIfExists('hero_sections');
    }
};
