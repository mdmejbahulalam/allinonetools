<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        if ($blog->status !== 'published') {
            abort(404);
        }

        return view('blogs.show', compact('blog'));
    }
}
