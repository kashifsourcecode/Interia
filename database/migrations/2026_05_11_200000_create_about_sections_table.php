<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('label');
            $table->string('title');
            $table->text('intro_paragraph_1');
            $table->text('intro_paragraph_2')->nullable();
            $table->string('mission_title');
            $table->text('mission_body');
            $table->string('vision_title');
            $table->text('vision_body');
            $table->string('footer_icon_path')->nullable();
            $table->string('footer_emphasis');
            $table->text('footer_body')->nullable();
            $table->string('hero_image_path')->nullable();
            $table->string('hero_image_alt')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_sections');
    }
};
