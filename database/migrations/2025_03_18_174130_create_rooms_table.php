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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');   // Room ka naam
            $table->string('room_type');   // e.g. Single, Double, Suite
            $table->decimal('price', 10, 2); // Price per night
            $table->integer('room_capacity'); // Kitne log reh sakte hain
            $table->text('facilities'); // Facilities e.g. WiFi, AC, TV
            $table->boolean('has_view')->default(false); // Window View hai ya nahi
            $table->string('image')->nullable(); // Room image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
