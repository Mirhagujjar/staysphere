<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\JsonResponse;
use App\Models\Blog;
use App\Models\PageSetting;

class GalleryController extends Controller
{
    // ============================
    // USER SIDE: View Gallery Page
    // ============================
    public function showGallery()
    {
        $blogs = Blog::with('gallery')
                    ->whereHas('gallery')
                    ->orderBy('published_date', 'desc')
                    ->get();

        $page = PageSetting::where('page_name', 'blog_main')->first();
        $mainGallery = [];

        if ($page) {
            $settings = is_array($page->settings) ? $page->settings : json_decode($page->settings, true);
            $mainGallery = $settings['gallery_images'] ?? [];
        }

        return view('user.gallery', [
            'blogs' => $blogs,
            'mainGallery' => $mainGallery,
            'title' => 'Our Gallery',
            'subtitle' => 'Collection of all images from our blog',
        ]);
    }

    // =====================================
    // ADMIN SIDE: View Manage Gallery Page
    // =====================================
    public function adminGallery()
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

        return view('admin.gallery', [
            'settings' => $settings
        ]);
    }

    // =====================================
    // ADMIN SIDE: Upload New Gallery Images
    // =====================================
    public function updateGallery(Request $request)
    {
        $request->validate([
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $page = PageSetting::where('page_name', 'blog_main')->firstOrFail();
        $settings = is_array($page->settings) ? $page->settings : json_decode($page->settings, true);

        if (!isset($settings['gallery_images'])) {
            $settings['gallery_images'] = [];
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = 'assets/images/pages/blog/' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images/pages/blog'), basename($path));
                $settings['gallery_images'][] = $path;
            }
        }

        $page->settings = $settings;
        $page->save();

        return back()->with('success', 'Gallery updated successfully!');
    }

    // ============================================
    // ADMIN SIDE: Delete a Specific Gallery Image
    // ============================================
    public function deleteGalleryImage($index): JsonResponse
    {
        $page = PageSetting::where('page_name', 'blog_main')->firstOrFail();
        $settings = is_array($page->settings) ? $page->settings : json_decode($page->settings, true);

        if (isset($settings['gallery_images'][$index])) {
            $imagePath = public_path($settings['gallery_images'][$index]);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            array_splice($settings['gallery_images'], $index, 1);
            $page->settings = $settings;
            $page->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Image not found.'], 404);
    }
}
