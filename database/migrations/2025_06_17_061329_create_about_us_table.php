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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('banner_title');
            $table->string('banner_subtitle');
            $table->string('banner_image')->nullable();
            $table->string('history_title');
            $table->string('history_subtitle');
            $table->text('history_content');
            $table->string('main_image')->nullable();
            $table->string('overlay_image')->nullable();
            $table->string('team_section_title');
            $table->string('team_section_subtitle');
            $table->string('faq_section_title');
            $table->string('faq_section_subtitle');
            $table->text('faq_contact_text');
            $table->timestamps();
        });

        // For team members
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // For FAQs
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
