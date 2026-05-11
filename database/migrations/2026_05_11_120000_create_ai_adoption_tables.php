<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_adoption_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('label');
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('framework_heading');
            $table->text('framework_description');
            $table->string('dashboard_image_path')->nullable();
            $table->string('dashboard_image_alt')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('ai_adoption_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ai_adoption_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('step_label');
            $table->string('title');
            $table->text('description');
            $table->string('style_key', 32)->default('detect');
            $table->string('icon_path')->nullable();
            $table->string('stat_emphasis')->nullable();
            $table->string('stat_caption')->nullable();
            $table->timestamps();
        });

        Schema::create('ai_adoption_checklist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ai_adoption_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('label');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_adoption_checklist_items');
        Schema::dropIfExists('ai_adoption_steps');
        Schema::dropIfExists('ai_adoption_sections');
    }
};
