<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::with('category')->paginate(20);
        return view('admin.tools.index', compact('tools'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.tools.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:tools',
            'description' => 'required|string',
            'keywords' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'blade_view' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Tool::create($validated);
        return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully!');
    }

    public function edit(Tool $tool)
    {
        $categories = Category::all();
        return view('admin.tools.edit', compact('tool', 'categories'));
    }

    public function update(Request $request, Tool $tool)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:tools,slug,' . $tool->id,
            'description' => 'required|string',
            'keywords' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'blade_view' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $tool->update($validated);
        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully!');
    }

    public function destroy(Tool $tool)
    {
        $tool->delete();
        return redirect()->route('admin.tools.index')->with('success', 'Tool deleted successfully!');
    }
}
