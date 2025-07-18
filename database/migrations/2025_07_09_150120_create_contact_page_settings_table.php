<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('contact_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('banner_heading');
            $table->string('breadcrumb');
            $table->text('left_section_text');
            $table->string('right_section_address');
            $table->string('right_section_phone');
            $table->string('right_section_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_page_settings');
    }
};
