<?php

// database/migrations/2025_06_17_create_blogs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create blogs table first
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('featured_image');
            $table->string('hero_image')->nullable();
            $table->date('published_date');
            $table->string('author')->default('Admin');
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        // Create blog_categories table next
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create the pivot table for blogs and categories
        Schema::create('blog_blog_category', function (Blueprint $table) {
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
            $table->foreignId('blog_category_id')->constrained()->onDelete('cascade');
            $table->primary(['blog_id', 'blog_category_id']);
        });

        // Finally create blog_galleries table after blogs exists
        Schema::create('blog_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->string('alt_text')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        // Drop tables in reverse order
        Schema::dropIfExists('blog_galleries');
        Schema::dropIfExists('blog_blog_category');
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('blogs');
    }
};