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
            // value column کو nullable سے non-nullable بنائیں
            $table->string('value')->nullable(false)->change();
            
            // order column شامل کریں
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
         // value column کو واپس nullable بنائیں
            $table->string('value')->nullable()->change();
            
            // order column کو حذف کریں
            $table->dropColumn('order');
    }
};
