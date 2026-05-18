<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('tools')->get();

        return response()->json([
            'data' => $categories->map(fn ($cat) => [
                'id' => $cat->id,
                'name' => $cat->name,
                'slug' => $cat->slug,
                'icon' => $cat->icon,
                'description' => $cat->description,
                'tools_count' => $cat->tools_count,
                'url' => route('category.show', $cat->slug)
            ])
        ]);
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with(['tools' => function ($q) {
            $q->where('status', 'active');
        }])->firstOrFail();

        return response()->json([
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'icon' => $category->icon,
            'description' => $category->description,
            'meta_title' => $category->meta_title,
            'meta_description' => $category->meta_description,
            'tools' => $category->tools->map(fn ($tool) => [
                'id' => $tool->id,
                'title' => $tool->title,
                'slug' => $tool->slug,
                'description' => $tool->description,
                'url' => route('tool.show', $tool->slug)
            ]),
            'url' => route('category.show', $category->slug)
        ]);
    }
}
