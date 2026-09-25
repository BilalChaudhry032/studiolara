<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['case_studies', 'testimonials'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                // Demonstration content: labelled "Sample project" on case studies,
                // and never shown publicly for testimonials.
                $table->boolean('is_sample')->default(false)->after('id');
            });

            // Everything seeded so far is placeholder content (see PRODUCT.md, Evidence on Hand).
            DB::table($table)->update(['is_sample' => true]);
        }
    }

    public function down(): void
    {
        foreach (['case_studies', 'testimonials'] as $table) {
            Schema::table($table, fn (Blueprint $table) => $table->dropColumn('is_sample'));
        }
    }
};
