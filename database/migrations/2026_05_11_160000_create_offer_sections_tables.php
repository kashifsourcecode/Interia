<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offer_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('label');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('offer_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('pill_label');
            $table->string('title');
            $table->text('description');
            $table->string('icon_path')->nullable();
            $table->string('cta_label');
            $table->string('cta_url')->nullable();
            $table->string('theme', 16)->default('gold');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offer_cards');
        Schema::dropIfExists('offer_sections');
    }
};
