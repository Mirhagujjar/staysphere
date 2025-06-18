<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogGallery;
use App\Models\PageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function editMainPage()
    {
        $page = PageSetting::firstOrCreate(
            ['page_name' => 'blog_main'],
            ['settings' => [
                'hero_image' => 'build/assets/images/blog/blog.jpg',
                'title' => 'Blog',
                'subtitle' => 'Latest travel tips, exclusive offers & hotel updates',
                'gallery_images' => []
            ]]
        );

        $settings = is_array($page->settings) ? $page->settings : json_decode($page->settings, true);

        return view('admin.blog.edit-main', [
            'settings' => $settings
        ]);
    }

    public function updateMainPage(Request $request)
    {
        $validated = $request->validate([
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:500'
        ]);

        $page = PageSetting::where('page_name', 'blog_main')->firstOrNew();
        
        // Properly decode settings if it's a JSON string
        $settings = is_string($page->settings) ? json_decode($page->settings, true) : ($page->settings ?? []);
        
        // Initialize gallery_images if it doesn't exist
        if (!isset($settings['gallery_images'])) {
            $settings['gallery_images'] = [];
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            // Delete old hero image if exists
            if (isset($settings['hero_image']) && $settings['hero_image'] !== 'build/assets/images/blog/blog.jpg') {
                Storage::delete('public/' . $settings['hero_image']);
            }
            
            $path = $request->file('hero_image')->store('pages/blog', 'public');
            $settings['hero_image'] = $path;
        }

        // Handle gallery uploads
        if ($request->hasFile('gallery_images')) {
            $gallery = $settings['gallery_images'] ?? [];
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('pages/blog', 'public');
                $gallery[] = $path;
            }
            $settings['gallery_images'] = $gallery;
        }

        // Update text fields
        $settings['title'] = $request->title;
        $settings['subtitle'] = $request->subtitle;

        $page->page_name = 'blog_main';
        $page->settings = $settings; // Laravel will automatically encode to JSON
        $page->save();

        return back()->with('success', 'Page updated successfully!');
    }

   

    public function deleteMainGalleryImage($index)
    {
        $page = PageSetting::where('page_name', 'blog_main')->firstOrFail();
        
        // Properly decode settings
        $settings = is_string($page->settings) ? json_decode($page->settings, true) : ($page->settings ?? []);
        
        if (isset($settings['gallery_images'][$index])) {
            Storage::delete('public/' . $settings['gallery_images'][$index]);
            array_splice($settings['gallery_images'], $index, 1);
            $page->settings = $settings;
            $page->save();
        }

        return back()->with('success', 'Image deleted successfully!');
    }

    public function index()
    {
        $blogs = Blog::orderBy('published_date', 'desc')->paginate(10);
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'required|image|max:2048',
            'hero_image' => 'nullable|image|max:2048',
            'published_date' => 'required|date',
            'author' => 'required|string|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
            'gallery_images.*' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->except(['categories', 'gallery_images']);
        $data['slug'] = Str::slug($request->title);
        $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('blogs', 'public');
        }

        $blog = Blog::create($data);

        if ($request->has('categories')) {
            $blog->categories()->sync($request->categories);
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('blogs/gallery', 'public');
                $blog->gallery()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'hero_image' => 'nullable|image|max:2048',
            'published_date' => 'required|date',
            'author' => 'required|string|max:255',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
            'gallery_images.*' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data = $request->except(['categories', 'gallery_images']);
        
        if ($request->hasFile('featured_image')) {
            Storage::delete('public/' . $blog->featured_image);
            $data['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }
        
        if ($request->hasFile('hero_image')) {
            if ($blog->hero_image) {
                Storage::delete('public/' . $blog->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('blogs', 'public');
        }

        $blog->update($data);

        if ($request->has('categories')) {
            $blog->categories()->sync($request->categories);
        }

       
        if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $image) {
            $path = $image->store('pages/blog', 'public'); // Consistent with your existing paths
            $settings['gallery_images'][] = $path;
        }
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        Storage::delete('public/' . $blog->featured_image);
        if ($blog->hero_image) {
            Storage::delete('public/' . $blog->hero_image);
        }
        
        foreach ($blog->gallery as $image) {
            Storage::delete('public/' . $image->image_path);
        }
        
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }

    // public function deleteGalleryImage(BlogGallery $image)
    // {
    //     Storage::delete('public/' . $image->image_path);
    //     $image->delete();
    //     return back()->with('success', 'Image deleted successfully');
    // }

    public function toggleStatus(Blog $blog)
    {
        $blog->status = !$blog->status;
        $blog->save();
        return back()->with('success', 'Status updated successfully');
    }
}
