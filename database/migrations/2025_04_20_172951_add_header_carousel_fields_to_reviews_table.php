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
    Schema::table('reviews', function (Blueprint $table) {
        $table->string('type')->nullable(); // user_review, header, carousel
        $table->string('title')->nullable(); // for header or carousel
        $table->text('description')->nullable(); // for header or carousel
        $table->string('image')->nullable(); // image for header or carousel
        // Don't need to add is_approved again (already there)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn(['type', 'title', 'description', 'image']);
        });
    }
};
