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
        Schema::table('filters', function (Blueprint $table) {
              if (!Schema::hasColumn('filters', 'slug')) {
                $table->string('slug')->unique()->after('type');
            }
            if (!Schema::hasColumn('filters', 'order')) {
                $table->integer('order')->default(0)->after('slug');
            }
            if (!Schema::hasColumn('filters', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('order');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('filters', function (Blueprint $table) {
                        $table->dropColumn(['slug', 'order', 'is_active']);

        });
    }
};
