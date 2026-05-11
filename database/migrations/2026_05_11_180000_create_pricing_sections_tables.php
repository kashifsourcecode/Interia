<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pricing_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->string('addons_title');
            $table->text('addons_subtitle')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->string('currency_symbol', 8)->default('$');
            $table->string('amount');
            $table->string('period')->default('/month');
            $table->json('features');
            $table->string('cta_label');
            $table->string('cta_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        Schema::create('pricing_addon_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_section_id')->constrained()->cascadeOnDelete();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->string('title');
            $table->string('icon_path')->nullable();
            $table->text('footer_description')->nullable();
            $table->json('rows');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pricing_addon_cards');
        Schema::dropIfExists('pricing_plans');
        Schema::dropIfExists('pricing_sections');
    }
};
