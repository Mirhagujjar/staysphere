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
        Schema::table('filter_options', function (Blueprint $table) {
            // Change value column to be non-nullable
            $table->string('value')->nullable(false)->change();
            
            // Add order column if it doesn't exist
            if (!Schema::hasColumn('filter_options', 'order')) {
                $table->unsignedInteger('order')->default(0)->after('value');
            }
            
            // Add is_active column if it doesn't exist
            if (!Schema::hasColumn('filter_options', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('order');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('filter_options', function (Blueprint $table) {
            // Revert value column to be nullable
            $table->string('value')->nullable()->change();
            
            // Remove columns if they exist
            if (Schema::hasColumn('filter_options', 'order')) {
                $table->dropColumn('order');
            }
            
            if (Schema::hasColumn('filter_options', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};