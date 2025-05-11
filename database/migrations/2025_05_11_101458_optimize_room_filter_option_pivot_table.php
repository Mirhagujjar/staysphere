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
         Schema::table('room_filter_option', function (Blueprint $table) {
            // id column 
           if (Schema::hasColumn('room_filter_option', 'id')) {
                $table->dropColumn('id');
            }
            
            // timestamps 
              if (Schema::hasColumn('room_filter_option', 'created_at') && 
                Schema::hasColumn('room_filter_option', 'updated_at')) {
                $table->dropTimestamps();
            }
            
            // composite primary key 
            $table->primary(['room_id', 'filter_option_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {        
            Schema::table('room_filter_option', function (Blueprint $table) {
            // primary key 
            $table->dropPrimary(['room_id', 'filter_option_id']);
            
        });
    }
};
