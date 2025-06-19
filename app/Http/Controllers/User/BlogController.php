<?php
// app/Http/Controllers/User/BlogController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\PageSetting;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // app/Http/Controllers/User/BlogController.php
   public function index()
    {
        $page = PageSetting::where('page_name', 'blog_main')->first();
        
        // Initialize default settings
        $defaultSettings = [
            'hero_image' => 'build/assets/images/blog/blog.jpg',
            'title' => 'Blog',
            'subtitle' => 'Latest travel tips, exclusive offers & hotel updates',
            'gallery_images' => []
        ];

        if ($page) {
            // Safely decode settings
            $settings = is_string($page->settings) 
                ? json_decode($page->settings, true) 
                : $page->settings;
            
            // Merge with defaults
            $settings = array_merge($defaultSettings, (array)$settings);
        } else {
            $settings = $defaultSettings;
        }

        // Ensure gallery_images is always an array
        $galleryImages = $settings['gallery_images'] ?? [];
        if (is_string($galleryImages)) {
            $galleryImages = json_decode($galleryImages, true) ?? [];
        }
        $settings['gallery_images'] = is_array($galleryImages)
            ? array_map(fn($path) => str_replace('\/', '/', $path), $galleryImages)
            : [];

        $blogs = Blog::where('status', true)
            ->orderBy('published_date', 'desc')
            ->paginate(6);

        $categories = BlogCategory::withCount('blogs')->get();
        $featured = Blog::where('is_featured', true)->take(3)->get();

        return view('user.blog.index', compact('settings', 'blogs', 'categories', 'featured'));
    }



    public function show(Blog $blog)
    {
        if (!$blog->status) {
            abort(404);
        }

        $related = Blog::where('status', true)
            ->where('id', '!=', $blog->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('user.blog.show', compact('blog', 'related'));
    }

    public function category(BlogCategory $category)
    {
        $blogs = $category->blogs()
            ->where('status', true)
            ->orderBy('published_date', 'desc')
            ->paginate(6);

        return view('user.blog.category', compact('category', 'blogs'));
    }


     public function showGallery()
    {
        // Get all blog posts with their galleries
        $blogs = Blog::with('gallery')
                    ->whereHas('gallery') // Only posts with gallery images
                    ->orderBy('published_date', 'desc')
                    ->get();

        // Get main page gallery images if you want to include them
        $page = PageSetting::where('page_name', 'blog_main')->first();
        $mainGallery = [];
        
        if ($page) {
            $settings = is_array($page->settings) ? $page->settings : json_decode($page->settings, true);
            $mainGallery = $settings['gallery_images'] ?? [];
        }

        return view('gallery', [
            'blogs' => $blogs,
            'mainGallery' => $mainGallery,
            'title' => 'Our Gallery',
            'subtitle' => 'Collection of all images from our blog'
        ]);
    }
}