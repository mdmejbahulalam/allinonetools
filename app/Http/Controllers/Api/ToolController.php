<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tool;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::where('status', 'active')
            ->with('category')
            ->paginate(20);

        return response()->json([
            'data' => $tools->map(fn ($tool) => [
                'id' => $tool->id,
                'title' => $tool->title,
                'slug' => $tool->slug,
                'description' => $tool->description,
                'category' => $tool->category ? [
                    'id' => $tool->category->id,
                    'name' => $tool->category->name,
                    'slug' => $tool->category->slug
                ] : null,
                'url' => route('tool.show', $tool->slug)
            ]),
            'pagination' => [
                'total' => $tools->total(),
                'per_page' => $tools->perPage(),
                'current_page' => $tools->currentPage(),
                'last_page' => $tools->lastPage()
            ]
        ]);
    }

    public function show($slug)
    {
        $tool = Tool::where('slug', $slug)->where('status', 'active')->with('category')->firstOrFail();

        return response()->json([
            'id' => $tool->id,
            'title' => $tool->title,
            'slug' => $tool->slug,
            'description' => $tool->description,
            'keywords' => $tool->keywords,
            'meta_title' => $tool->meta_title,
            'meta_description' => $tool->meta_description,
            'category' => $tool->category ? [
                'id' => $tool->category->id,
                'name' => $tool->category->name,
                'slug' => $tool->category->slug
            ] : null,
            'url' => route('tool.show', $tool->slug)
        ]);
    }
}
