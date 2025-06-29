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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->text('long_description');
            $table->string('price');
            $table->string('thumbnail');               // For card/listing view
            $table->string('detail_image')->nullable(); // For service detail hero

            // Hero section specific (for detail page)
            $table->string('hero_title')->nullable();       // e.g., "Housekeeping Services"
            $table->string('hero_subtitle')->nullable();    // e.g., "A Spotless Stay, Every Day"
            $table->string('hero_background')->nullable();  // image path if different from detail_image

            $table->json('facilities')->nullable();         // JSON encoded
            $table->string('modal_button_text')->nullable(); // e.g., "Request Now"
            $table->json('modal_fields');                   // Field structure for modals

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
