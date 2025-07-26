<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\ExperienceCard;
use App\Models\Event;

class PageBuilderController extends Controller
{
    public function index() {
        return view('admin.page_builder.index'); // Custom page builder view
    }

    public function storeHero(Request $request) {
        HeroSection::create($request->only('title', 'subtitle', 'image'));
        return back()->with('success', 'Hero section added');
    }

    public function storeCard(Request $request) {
        ExperienceCard::create($request->only('title', 'description', 'icon'));
        return back()->with('success', 'Card added');
    }

    public function storeEvent(Request $request) {
        Event::create($request->only('title', 'date', 'location'));
        return back()->with('success', 'Event added');
    }

    public function showContent() {
        return view('admin.events.index', [
            'heros' => HeroSection::all(),
            'cards' => ExperienceCard::all(),
            'events' => Event::all(),
        ]);
    }

    public function destroy($type, $id) {
        if ($type == 'hero') HeroSection::destroy($id);
        elseif ($type == 'card') ExperienceCard::destroy($id);
        elseif ($type == 'event') Event::destroy($id);

        return back()->with('success', 'Deleted successfully');
    }
}
