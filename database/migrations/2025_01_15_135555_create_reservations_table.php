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
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('room_id'); // Correct data type
        $table->string('name');
        $table->string('email');
        $table->string('phone');
        $table->date('check_in');
        $table->date('check_out');
        $table->integer('guests');
        $table->enum('status', ['pending', 'confirmed', 'checked_out'])->default('pending');
        $table->timestamps();

        // Foreign Key
        $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
