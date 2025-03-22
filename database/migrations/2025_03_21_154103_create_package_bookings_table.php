<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('package_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('package_id');
            $table->date('check_in');
            $table->date('check_out');
            $table->string('payment_method');
            $table->text('special_requests')->nullable();
            $table->timestamps();
    
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_bookings');
    }
};
