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
        Schema::create('user_event_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
        $table->string('email');
        $table->string('phone');
        $table->integer('guests');
        $table->date('event_date');
        $table->string('event_type'); // Dropdown

        $table->string('title');
        $table->text('description');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_event_bookings');
    }
};
