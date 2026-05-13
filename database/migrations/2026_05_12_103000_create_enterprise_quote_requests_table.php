<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enterprise_quote_requests', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('job_title')->nullable();

            $table->string('company');
            $table->string('website')->nullable();
            $table->string('industry')->nullable();

            $table->string('employee_count')->nullable();
            $table->string('endpoint_count')->nullable();
            $table->string('location_count')->nullable();

            $table->string('current_it_setup')->nullable();
            $table->json('cloud_platforms')->nullable();
            $table->json('services_needed')->nullable();
            $table->json('compliance_needs')->nullable();

            $table->string('budget_range')->nullable();
            $table->string('timeline')->nullable();
            $table->string('preferred_contact')->nullable();

            $table->text('details')->nullable();

            $table->string('status', 16)->default('new');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 512)->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enterprise_quote_requests');
    }
};
