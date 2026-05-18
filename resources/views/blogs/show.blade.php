@extends('layouts.app')

@section('title', $blog->meta_title ?? $blog->title . ' - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-4xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <a href="{{ route('blog.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Blog</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">{{ $blog->title }}</span>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-12">
        @if($blog->featured_image)
            <div class="mb-8 rounded-lg overflow-hidden h-96 bg-gray-200 dark:bg-gray-700">
                <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <article class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 md:p-12">
            <header class="mb-8 pb-8 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ $blog->title }}</h1>

                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                    <span>By {{ $blog->author->name ?? 'Unknown' }}</span>
                    <span>•</span>
                    <time datetime="{{ $blog->published_at->toIso8601String() }}">
                        {{ $blog->published_at->format('F d, Y') }}
                    </time>
                    <span>•</span>
                    <span>{{ ceil(str_word_count($blog->content) / 200) }} min read</span>
                </div>
            </header>

            <div class="prose dark:prose-invert max-w-none mb-8">
                <div class="text-gray-800 dark:text-gray-300 leading-relaxed">
                    {!! nl2br(e($blog->content)) !!}
                </div>
            </div>

            <footer class="pt-8 border-t border-gray-200 dark:border-gray-700">
                @if($blog->keywords)
                    <div>
                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tags</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $blog->keywords) as $keyword)
                                <span class="inline-block px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-full text-sm">
                                    {{ trim($keyword) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </footer>
        </article>

        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">More Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $relatedBlogs = \App\Models\Blog::where('status', 'published')
                        ->where('id', '!=', $blog->id)
                        ->orderBy('published_at', 'desc')
                        ->limit(2)
                        ->get();
                @endphp

                @forelse($relatedBlogs as $relatedBlog)
                    <a href="{{ route('blog.show', $relatedBlog) }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition">
                        <div class="h-32 bg-gradient-to-br from-blue-500 to-purple-500"></div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ $relatedBlog->title }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ substr($relatedBlog->excerpt, 0, 100) }}...</p>
                            <span class="text-blue-600 dark:text-blue-400 text-sm font-medium">Read More →</span>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-600 dark:text-gray-400 col-span-full">No other articles available</p>
                @endforelse
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('blog.index') }}" class="inline-block text-blue-600 dark:text-blue-400 hover:underline">
                ← Back to Blog
            </a>
        </div>
    </div>
</div>
@endsection
