<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogGallery;
use App\Models\PageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function editMainPage()
    {
        $page = PageSetting::firstOrCreate(
            ['page_name' => 'blog_main'],
            ['settings' => [
                'hero_image' => 'assets/images/blog/blog.jpg',
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

        $settings = is_string($page->settings) ? json_decode($page->settings, true) : ($page->settings ?? []);
        if (!isset($settings['gallery_images'])) {
            $settings['gallery_images'] = [];
        }

        if ($request->hasFile('hero_image')) {
            if (isset($settings['hero_image']) && File::exists(public_path($settings['hero_image'])) && $settings['hero_image'] !== 'assets/images/blog/blog.jpg') {
                File::delete(public_path($settings['hero_image']));
            }

            $image = $request->file('hero_image');
            $path = 'assets/images/pages/blog/' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/pages/blog'), basename($path));
            $settings['hero_image'] = $path;
        }

        if ($request->hasFile('gallery_images')) {
            $gallery = $settings['gallery_images'] ?? [];
            foreach ($request->file('gallery_images') as $image) {
                $path = 'assets/images/pages/blog/' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images/pages/blog'), basename($path));
                $gallery[] = $path;
            }
            $settings['gallery_images'] = $gallery;
        }

        $settings['title'] = $request->title;
        $settings['subtitle'] = $request->subtitle;

        $page->page_name = 'blog_main';
        $page->settings = $settings;
        $page->save();

        return back()->with('success', 'Page updated successfully!');
    }

    public function deleteMainGalleryImage($index)
    {
        $page = PageSetting::where('page_name', 'blog_main')->firstOrFail();
        $settings = is_string($page->settings) ? json_decode($page->settings, true) : ($page->settings ?? []);

        if (isset($settings['gallery_images'][$index])) {
            File::delete(public_path($settings['gallery_images'][$index]));
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

        $featured = $request->file('featured_image');
        $featuredPath = 'assets/images/blogs/' . uniqid() . '.' . $featured->getClientOriginalExtension();
        $featured->move(public_path('assets/images/blogs'), basename($featuredPath));
        $data['featured_image'] = $featuredPath;

        if ($request->hasFile('hero_image')) {
            $hero = $request->file('hero_image');
            $heroPath = 'assets/images/blogs/' . uniqid() . '.' . $hero->getClientOriginalExtension();
            $hero->move(public_path('assets/images/blogs'), basename($heroPath));
            $data['hero_image'] = $heroPath;
        }

        $blog = Blog::create($data);

        if ($request->has('categories')) {
            $blog->categories()->sync($request->categories);
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = 'assets/images/blogs/gallery/' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images/blogs/gallery'), basename($path));
                $blog->gallery()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.gallery')->with('success', 'Blog created successfully');
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
            File::delete(public_path($blog->featured_image));
            $image = $request->file('featured_image');
            $path = 'assets/images/blogs/' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/blogs'), basename($path));
            $data['featured_image'] = $path;
        }

        if ($request->hasFile('hero_image')) {
            if ($blog->hero_image) {
                File::delete(public_path($blog->hero_image));
            }
            $image = $request->file('hero_image');
            $path = 'assets/images/blogs/' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/blogs'), basename($path));
            $data['hero_image'] = $path;
        }

        $blog->update($data);

        if ($request->has('categories')) {
            $blog->categories()->sync($request->categories);
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = 'assets/images/blogs/gallery/' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images/blogs/gallery'), basename($path));
                $blog->gallery()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        File::delete(public_path($blog->featured_image));
        if ($blog->hero_image) {
            File::delete(public_path($blog->hero_image));
        }

        foreach ($blog->gallery as $image) {
            File::delete(public_path($image->image_path));
        }

        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully');
    }

    // public function deleteGalleryImage($id)
    // {
    //     $image = BlogGallery::findOrFail($id);
        
    //     // Delete the physical file
    //     if (Storage::exists(str_replace('storage/', 'public/', $image->image_path))) {
    //         Storage::delete(str_replace('storage/', 'public/', $image->image_path));
    //     }
        
    //     // Delete the database record
    //     $image->delete();
        
    //     return back()->with('success', 'Image deleted successfully');
    // }

    public function toggleStatus(Blog $blog)
    {
        $blog->status = !$blog->status;
        $blog->save();
        return back()->with('success', 'Status updated successfully');
    }

//     public function gallery()
// {
//     $page = PageSetting::firstOrCreate(
//     ['page_name' => 'blog_main'],
//     ['settings' => [
//         'hero_image' => 'assets/images/blog/blog.jpg',
//         'title' => 'Blog',
//         'subtitle' => 'Latest travel tips, exclusive offers & hotel updates',
//         'gallery_images' => []
//     ]]
// );



//     $settings = is_array($page->settings) ? $page->settings : json_decode($page->settings, true);
//     return view('admin.gallery', compact('settings'));
// }

// public function updateGallery(Request $request)
// {
//     $request->validate([
//         'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
//     ]);

//     $page = PageSetting::where('page_name', 'blog_main')->firstOrFail();
//     $settings = is_array($page->settings) ? $page->settings : json_decode($page->settings, true);

//     if (!isset($settings['gallery_images'])) {
//         $settings['gallery_images'] = [];
//     }

//     if ($request->hasFile('gallery_images')) {
//         foreach ($request->file('gallery_images') as $image) {
//             $path = 'assets/images/pages/blog/' . uniqid() . '.' . $image->getClientOriginalExtension();
//             $image->move(public_path('assets/images/pages/blog'), basename($path));
//             $settings['gallery_images'][] = $path;
//         }
//     }

//     $page->settings = $settings;
//     $page->save();

//     return back()->with('success', 'Gallery updated successfully!');
// }

// public function deleteGalleryImage($index)
// {
//     $page = PageSetting::where('page_name', 'blog_main')->firstOrFail();
//     $settings = is_array($page->settings) ? $page->settings : json_decode($page->settings, true);

//     if (isset($settings['gallery_images'][$index])) {
//         $imagePath = public_path($settings['gallery_images'][$index]);
//         if (file_exists($imagePath)) {
//             unlink($imagePath);
//         }
//         array_splice($settings['gallery_images'], $index, 1);
//         $page->settings = $settings;
//         $page->save();
//     }

//     return response()->json(['success' => true]);
// }

}
