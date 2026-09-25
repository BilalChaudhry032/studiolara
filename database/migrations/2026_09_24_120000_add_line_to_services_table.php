<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // One of Service::LINES. It sets the service's route letter and colour site-wide.
            $table->string('line', 1)->nullable()->unique()->after('slug');
        });

        // Backfill the five seeded services so existing installs match fresh ones.
        foreach (['uiux-design' => 'u', 'web-development' => 'w', 'saas-product-development' => 's', 'mobile-app-design-dev' => 'm', 'cms-development' => 'c'] as $slug => $line) {
            DB::table('services')->where('slug', $slug)->update(['line' => $line]);
        }
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropUnique(['line']);
            $table->dropColumn('line');
        });
    }
};
