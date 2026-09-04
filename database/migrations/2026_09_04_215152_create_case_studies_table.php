<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client')->nullable();
            $table->string('category')->nullable();
            $table->longText('about');
            $table->json('tools')->nullable();
            $table->json('service_tags')->nullable();
            $table->json('challenges')->nullable();
            $table->json('problems_solutions')->nullable();
            $table->longText('outcome_results')->nullable();
            $table->text('testimonial_quote')->nullable();
            $table->string('testimonial_author')->nullable();
            $table->string('testimonial_title')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};
