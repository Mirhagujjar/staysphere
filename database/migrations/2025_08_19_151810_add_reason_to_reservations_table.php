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
       Schema::table('package_bookings', function (Blueprint $table) {
    if (!Schema::hasColumn('package_bookings', 'user_id')) {
        $table->unsignedBigInteger('user_id')->after('id');
    }
    if (!Schema::hasColumn('package_bookings', 'status')) {
        $table->string('status')->default('pending')->after('user_id');
    }
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('reason');   
        });
    }
};
