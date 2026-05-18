<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::with('tools')->get();
        $topTools = \App\Models\Tool::orderBy('views', 'desc')->limit(12)->get();
        return view('home', compact('categories', 'topTools'));
    }

    public function show($slug, Request $request)
    {
        $tool = \App\Models\Tool::where('slug', $slug)->firstOrFail();

        if ($tool->status === 'inactive') {
            abort(404);
        }

        \App\Models\ToolView::create([
            'tool_id' => $tool->id,
            'ip' => $request->ip(),
        ]);

        $tool->increment('views');

        $relatedTools = \App\Models\Tool::where('category_id', $tool->category_id)
            ->where('id', '!=', $tool->id)
            ->limit(4)
            ->get();

        $faqs = $tool->faqs;
        $category = $tool->category;

        return view('tools.show', compact('tool', 'relatedTools', 'faqs', 'category'));
    }

    public function category($slug, Request $request)
    {
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
        $tools = $category->tools()->where('status', 'active')->paginate(12);
        return view('tools.category', compact('category', 'tools'));
    }
}
