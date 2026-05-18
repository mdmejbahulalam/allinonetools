<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(15);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs',
            'content' => 'required|string',
            'excerpt' => 'required|string|max:500',
            'featured_image' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'keywords' => 'nullable|string'
        ]);

        $validated['author_id'] = auth('admin')->id();

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully!');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug,' . $blog->id,
            'content' => 'required|string',
            'excerpt' => 'required|string|max:500',
            'featured_image' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'keywords' => 'nullable|string'
        ]);

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully!');
    }
}
