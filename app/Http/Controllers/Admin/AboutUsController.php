<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\TeamMember;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutUsController extends Controller
{
    public function show()
    {
        $about = AboutUs::firstOrFail();
        $teamMembers = TeamMember::orderBy('order')->get();
        $faqs = Faq::orderBy('order')->get();

        return view('admin.about.show', compact('about', 'teamMembers', 'faqs'));
    }

    public function edit()
    {
        $about = AboutUs::firstOrNew();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'banner_title' => 'required',
            'banner_subtitle' => 'required',
            'history_title' => 'required',
            'history_subtitle' => 'required',
            'history_content' => 'required',
            'team_section_title' => 'required',
            'team_section_subtitle' => 'required',
            'faq_section_title' => 'required',
            'faq_section_subtitle' => 'required',
            'faq_contact_text' => 'required',
            'banner_image' => 'nullable|image',
            'main_image' => 'nullable|image',
            'overlay_image' => 'nullable|image'
        ]);

        $about = AboutUs::firstOrNew();

        foreach (['banner_image', 'main_image', 'overlay_image'] as $imageField) {
            if ($request->hasFile($imageField)) {
                if ($about->$imageField && File::exists(public_path($about->$imageField))) {
                    File::delete(public_path($about->$imageField));
                }
                $image = $request->file($imageField);
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('assets/images/aboutus'), $imageName);
                $data[$imageField] = 'assets/images/aboutus/' . $imageName;
            } elseif (isset($about->$imageField)) {
                $data[$imageField] = $about->$imageField;
            }
        }

        $about->fill($data);
        $about->save();

        return redirect()->route('admin.about.edit')->with('success', 'About Us page updated successfully');
    }

    public function teamIndex()
    {
        $teamMembers = TeamMember::orderBy('order')->get();
        return view('admin.about.team.index', compact('teamMembers'));
    }

    public function teamCreate()
    {
        return view('admin.about.team.form');
    }

    public function teamStore(Request $request)
    {
        $data = $this->validateTeamMember($request);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images/aboutus'), $imageName);
            $data['image'] = 'assets/images/aboutus/' . $imageName;
        }

        TeamMember::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully');
    }

    public function teamEdit(TeamMember $teamMember)
    {
        return view('admin.about.team.form', compact('teamMember'));
    }

    public function teamUpdate(Request $request, TeamMember $teamMember)
    {
        $data = $this->validateTeamMember($request);

        if ($request->hasFile('image')) {
            if ($teamMember->image && File::exists(public_path($teamMember->image))) {
                File::delete(public_path($teamMember->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images/aboutus'), $imageName);
            $data['image'] = 'assets/images/aboutus/' . $imageName;
        } else {
            $data['image'] = $teamMember->image;
        }

        $teamMember->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully');
    }

    public function teamDestroy(TeamMember $teamMember)
    {
        if ($teamMember->image && File::exists(public_path($teamMember->image))) {
            File::delete(public_path($teamMember->image));
        }
        $teamMember->delete();

        return redirect()->route('admin.about.team.index')->with('success', 'Team member deleted successfully');
    }

    public function faqIndex()
    {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.about.faq-index', compact('faqs'));
    }

    public function faqCreate()
    {
        return view('admin.about.faq-form');
    }

    public function faqStore(Request $request)
    {
        $data = $this->validateFaq($request);
        Faq::create($data);

        return redirect()->route('admin.about.faq-index')->with('success', 'FAQ added successfully');
    }

    public function faqEdit(Faq $faq)
    {
        return view('admin.about.faq-form', compact('faq'));
    }

    public function faqUpdate(Request $request, Faq $faq)
    {
        $data = $this->validateFaq($request);
        $faq->update($data);

        return redirect()->route('admin.about.faq-index')->with('success', 'FAQ updated successfully');
    }

    public function faqDestroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.about.faq.index')->with('success', 'FAQ deleted successfully');
    }

    protected function validateTeamMember(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'order' => 'nullable|integer'
        ]);
    }

    protected function validateFaq(Request $request)
    {
        return $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer'
        ]);
    }
}
