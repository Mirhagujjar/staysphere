<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\PageSetting;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $page = PageSetting::where('page_name', 'blog_main')->first();

        // Default settings
        $defaultSettings = [
            'hero_image' => 'assets/images/blog/blog.jpg',
            'title' => 'Blog',
            'subtitle' => 'Latest travel tips, exclusive offers & hotel updates',
            'gallery_images' => []
        ];

        // Merge stored settings with defaults
        if ($page) {
            $settings = is_string($page->settings)
                ? json_decode($page->settings, true)
                : $page->settings;
            $settings = array_merge($defaultSettings, (array)$settings);
        } else {
            $settings = $defaultSettings;
        }

        // Handle gallery images cleanup
        $galleryImages = $settings['gallery_images'] ?? [];
        if (is_string($galleryImages)) {
            $galleryImages = json_decode($galleryImages, true) ?? [];
        }
        $settings['gallery_images'] = is_array($galleryImages)
            ? array_map(fn($path) => str_replace('\/', '/', $path), $galleryImages)
            : [];

        // Search handling
        $query = $request->input('query');
        $blogs = Blog::where('status', true)
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                  ->orWhere('excerpt', 'like', '%' . $query . '%');
            })
            ->orderBy('published_date', 'desc')
            ->paginate(6)
            ->withQueryString();

        $categories = BlogCategory::withCount('blogs')->get();
        $featured = Blog::where('is_featured', true)->take(3)->get();

        return view('user.blog.index', compact('settings', 'blogs', 'categories', 'featured', 'query'));
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

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:3'
        ]);

        $query = $request->input('query');

        $blogs = Blog::where('status', true)
            ->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->orderBy('published_date', 'desc')
            ->paginate(6)
            ->appends(['query' => $query]);

        $page = PageSetting::where('page_name', 'blog_main')->first();
        $settings = $page ? (is_string($page->settings) ? json_decode($page->settings, true) : $page->settings) : [
            'hero_image' => 'assets/images/blog/blog.jpg',
            'title' => 'Search Results',
            'subtitle' => "Showing results for: {$query}"
        ];

        return view('user.blog.search', compact('blogs', 'settings', 'query'));
    }

    // public function showGallery()
    // {
    //     // Get all blog posts with their galleries
    //     $blogs = Blog::with('gallery')
    //                 ->whereHas('gallery')
    //                 ->orderBy('published_date', 'desc')
    //                 ->get();

<<<<<<< Updated upstream
    //     // Get main page gallery images
    //     $page = PageSetting::where('page_name', 'blog_main')->first();
    //     $mainGallery = [];

    //     if ($page) {
    //         $settings = is_array($page->settings) ? $page->settings : json_decode($page->settings, true);
    //         $mainGallery = $settings['gallery_images'] ?? [];
    //     }

    //     return view('gallery', [
    //         'blogs' => $blogs,
    //         'mainGallery' => $mainGallery,
    //         'title' => 'Our Gallery',
    //         'subtitle' => 'Collection of all images from our blog'
    //     ]);
    // }
=======
        // Get main page gallery images
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
>>>>>>> Stashed changes
}
