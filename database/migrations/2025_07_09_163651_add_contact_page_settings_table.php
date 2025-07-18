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
    Schema::table('contact_page_settings', function (Blueprint $table) {
        $table->string('half_page_image')->nullable();
        $table->string('contact_section_image')->nullable();
        $table->string('contact_info_heading')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_page_settings', function (Blueprint $table) {
        $table->string('half_page_image')->nullable();
        $table->string('contact_section_image')->nullable();
        $table->string('contact_info_heading')->nullable();
    });
    }
};
