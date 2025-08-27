<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPageSetting;
use Illuminate\Http\Request;

class ContactPageSettingController extends Controller
{
    public function index()
    {
        $settings = ContactPageSetting::latest()->first();
        return view('admin.contact.contact_settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.contact.contact_settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'breadcrumb' => 'required|string|max:255',
            'left_section_text' => 'required|string',
            'right_section_address' => 'required|string',
            'right_section_phone' => 'required|string',
            'right_section_email' => 'required|email',
            'contact_info_heading' => 'nullable|string|max:255',
            'half_page_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'contact_section_image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = $request->only([
            'banner_heading', 'breadcrumb', 'left_section_text',
            'right_section_address', 'right_section_phone',
            'right_section_email', 'contact_info_heading'
        ]);

        if ($request->hasFile('half_page_image')) {
            $name = time().'_half.'.$request->half_page_image->extension();
            $request->half_page_image->move(public_path('assets/images/contact'), $name);
            $data['half_page_image'] = 'assets/images/contact/'.$name;
        }

        if ($request->hasFile('contact_section_image')) {
            $name = time().'_section.'.$request->contact_section_image->extension();
            $request->contact_section_image->move(public_path('assets/images/contact'), $name);
            $data['contact_section_image'] = 'assets/images/contact/'.$name;
        }

        ContactPageSetting::create($data);

        return redirect()->route('admin.contact-settings.index')
            ->with('success', 'Contact page settings created successfully.');
    }

    public function edit($id)
    {
        $settings = ContactPageSetting::findOrFail($id);
        return view('admin.contact.contact_settings.edit', compact('settings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'breadcrumb' => 'required|string|max:255',
            'left_section_text' => 'required|string',
            'right_section_address' => 'required|string',
            'right_section_phone' => 'required|string',
            'right_section_email' => 'required|email',
            'contact_info_heading' => 'nullable|string|max:255',
            'half_page_image' => 'nullable|image|mimes:jpg,jpeg,png',
            'contact_section_image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $settings = ContactPageSetting::findOrFail($id);

        $data = $request->only([
            'banner_heading', 'breadcrumb', 'left_section_text',
            'right_section_address', 'right_section_phone',
            'right_section_email', 'contact_info_heading'
        ]);

        if ($request->hasFile('half_page_image')) {
            $extension = $request->half_page_image->extension(); // gets jpg, png etc.
            $name = time().'_half.'.$extension;
            $request->half_page_image->move(public_path('assets/images/contact'), $name);
            $data['half_page_image'] = 'assets/images/contact/'.$name;
        }


        if ($request->hasFile('contact_section_image')) {
            $name = time().'_section.'.$request->contact_section_image->extension();
            $request->contact_section_image->move(public_path('assets/images/contact'), $name);
            $data['contact_section_image'] = 'assets/images/contact/'.$name;
        }

        $settings->update($data);

        return redirect()->route('admin.contact-settings.index')
            ->with('success', 'Contact page settings updated successfully.');
    }
}