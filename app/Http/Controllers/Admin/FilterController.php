<?php

// app/Http/Controllers/Admin/FilterController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Filter;
use App\Models\FilterOption;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    // Show all filters
    public function index()
    {
        $filters = Filter::with('options')->orderBy('order')->get();
        return view('admin.filters.index', compact('filters'));
    }

    // Show create filter form
    public function create()
    {
        return view('admin.filters.create');
    }

    // Store new filter
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:checkbox,dropdown',
            'slug' => 'required|alpha_dash|unique:filters,slug',
        ]);

        Filter::create([
            'name' => $request->name,
            'type' => $request->type,
            'slug' => $request->slug,
            'order' => Filter::count() + 1,
        ]);

        return redirect()->route('admin.filters.index')->with('success', 'Filter added successfully!');
    }

    // Show edit filter form
    public function edit(Filter $filter)
    {
        return view('admin.filters.edit', compact('filter'));
    }

    // Update filter
    public function update(Request $request, Filter $filter)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:checkbox,dropdown',
            'slug' => 'required|alpha_dash|unique:filters,slug,'.$filter->id,
        ]);

        $filter->update($request->only(['name', 'type', 'slug']));

        return redirect()->route('admin.filters.index')->with('success', 'Filter updated successfully!');
    }

    // Delete filter
    public function destroy(Filter $filter)
    {
        $filter->delete();
        return redirect()->route('admin.filters.index')->with('success', 'Filter deleted successfully!');
    }

    // Show filter options
    public function showOptions(Filter $filter)
    {
        $options = $filter->options()->orderBy('order')->get();
        return view('admin.filters.options', compact('filter', 'options'));
    }

    // Store new option
    public function storeOption(Request $request, Filter $filter)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        $filter->options()->create([
            'label' => $request->label,
            'value' => $request->value,
            'order' => $filter->options()->count() + 1,
        ]);

        return back()->with('success', 'Option added successfully!');
    }

    // Update option
    public function updateOption(Request $request, FilterOption $option)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);

        $option->update($request->only(['label', 'value']));

        return back()->with('success', 'Option updated successfully!');
    }

    // Delete option
    public function deleteOption(FilterOption $option)
    {
        $option->delete();
        return back()->with('success', 'Option deleted successfully!');
    }

    // Update filter order
    public function updateOrder(Request $request)
    {
        foreach ($request->order as $order => $id) {
            Filter::where('id', $id)->update(['order' => $order]);
        }
        
        return response()->json(['success' => true]);
    }

    // Update option order
    public function updateOptionOrder(Request $request)
    {
        foreach ($request->order as $order => $id) {
            FilterOption::where('id', $id)->update(['order' => $order]);
        }
        
        return response()->json(['success' => true]);
    }
}
