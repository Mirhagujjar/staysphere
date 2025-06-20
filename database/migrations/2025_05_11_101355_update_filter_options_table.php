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
            $table->string('value')->nullable(false)->change();
            
            if (!Schema::hasColumn('filter_options', 'order')) {
                $table->integer('order')->default(0)->after('value');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            $table->string('value')->nullable()->change();
            
            $table->dropColumn('order');
    }
};
