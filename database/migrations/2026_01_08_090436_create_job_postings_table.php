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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();

            // Job details
            $table->string('job_title');
            $table->text('description');

            // Experience & salary as string (range based)
            $table->string('experience', 20)->nullable(); // Eg: 1-3 Yrs
            $table->string('salary', 50)->nullable();     // Eg: 2.75–5 Lacs PA

            $table->string('location', 100)->nullable();
            $table->json('extra_info')->nullable(); // Full Time, Urgent, etc.

            // Company details
            $table->string('company_name');
            $table->string('logo')->nullable(); // image path

            // Skills (multi-select)
            $table->json('skills')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
