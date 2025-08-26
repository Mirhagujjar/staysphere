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
           Schema::table('reservations', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('room_type')->nullable()->change();
            $table->date('check_in')->nullable()->change();
            $table->date('check_out')->nullable()->change();
             $table->integer('guests')->nullable()->change(); // 👈 ye line add karo

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('reservations', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('room_type')->nullable(false)->change();
            $table->date('check_in')->nullable(false)->change();
            $table->date('check_out')->nullable(false)->change();
            $table->integer('guests')->nullable(false)->change(); // 👈 ye line add karo

        });
    }
};
