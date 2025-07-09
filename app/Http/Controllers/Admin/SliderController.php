<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPageSetting;
use Illuminate\Http\Request;

class ContactPageSettingController extends Controller
{
    public function index()
    {
        $settings = ContactPageSetting::first();
        return view('admin.contact.contact_settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.contact.contact_settings.create');
    }

        public function store(Request $request)
    {
        $request->validate([
            'banner_heading'         => 'required|string|max:255',
            'breadcrumb'             => 'required|string|max:255',
            'left_section_text'      => 'required|string',
            'right_section_address'  => 'required|string',
            'right_section_phone'    => 'required|string',
            'right_section_email'    => 'required|email',
            'half_page_image'      => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'contact_info_heading'   => 'required|string|max:255',
            'contact_section_image'          => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only([
            'banner_heading',
            'breadcrumb',
            'left_section_text',
            'right_section_address',
            'right_section_phone',
            'right_section_email',
            'contact_info_heading',
        ]);

        if ($request->hasFile('half_page_image')) {
            $imageName = time().'_half.'.$request->half_page_image->extension();
            $request->half_page_image->move(public_path('assets/images/contact'), $imageName);
            $data['half_page_image'] = 'assets/images/contact/'.$imageName;
        }

        if ($request->hasFile('contact_section_image')) {
            $imageName = time().'_contact.'.$request->contact_section_image->extension();
            $request->contact_section_image->move(public_path('assets/images/contact'), $imageName);
            $data['contact_section_image'] = 'assets/images/contact/'.$imageName;
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
        'banner_heading'         => 'required|string|max:255',
        'breadcrumb'             => 'required|string|max:255',
        'left_section_text'      => 'required|string',
        'right_section_address'  => 'required|string',
        'right_section_phone'    => 'required|string',
        'right_section_email'    => 'required|email',
        'half_page_image'      => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'contact_info_heading'   => 'required|string|max:255',
        'contact_section_image'          => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $settings = ContactPageSetting::findOrFail($id);

    $data = $request->only([
        'banner_heading',
        'breadcrumb',
        'left_section_text',
        'right_section_address',
        'right_section_phone',
        'right_section_email',
        'contact_info_heading',
    ]);

    if ($request->hasFile('half_page_image')) {
        $imageName = time().'_half.'.$request->half_page_image->extension();
        $request->half_page_image->move(public_path('assets/images/contact'), $imageName);
        $data['half_page_image'] = 'assets/images/contact/'.$imageName;
    }

    if ($request->hasFile('contact_section_image')) {
        $imageName = time().'_contact.'.$request->contact_section_image->extension();
        $request->contact_section_image->move(public_path('assets/images/contact'), $imageName);
        $data['contact_section_image'] = 'assets/images/contact/'.$imageName;
    }

    $settings->update($data);

    return redirect()->route('admin.contact-settings.index')
        ->with('success', 'Contact page settings updated successfully.');
}

}
