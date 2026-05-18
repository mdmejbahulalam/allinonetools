<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json(['tools' => [], 'categories' => []]);
        }

        $tools = Tool::where('status', 'active')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->orWhere('keywords', 'like', "%$query%");
            })
            ->with('category')
            ->limit(10)
            ->get()
            ->map(fn ($tool) => [
                'id' => $tool->id,
                'title' => $tool->title,
                'slug' => $tool->slug,
                'description' => substr($tool->description, 0, 100),
                'category' => $tool->category->name ?? null,
                'url' => route('tool.show', $tool->slug)
            ]);

        $categories = Category::where(function ($q) use ($query) {
            $q->where('name', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%");
        })
            ->limit(5)
            ->get()
            ->map(fn ($cat) => [
                'id' => $cat->id,
                'name' => $cat->name,
                'slug' => $cat->slug,
                'url' => route('category.show', $cat->slug)
            ]);

        return response()->json([
            'tools' => $tools,
            'categories' => $categories,
            'query' => $query
        ]);
    }
}
