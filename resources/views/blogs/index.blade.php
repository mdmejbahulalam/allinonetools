@extends('layouts.app')

@section('title', 'Blog - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Blog</span>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Blog</h1>
            <p class="text-xl text-gray-600 dark:text-gray-400">Articles and updates about our tools and platform</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($blogs as $blog)
                <a href="{{ route('blog.show', $blog) }}" class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
                    @if($blog->featured_image)
                        <div class="h-40 bg-gray-200 dark:bg-gray-700 overflow-hidden">
                            <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="h-40 bg-gradient-to-br from-blue-500 to-purple-500"></div>
                    @endif

                    <div class="p-6">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $blog->title }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ $blog->excerpt }}</p>

                        <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $blog->published_at->format('M d, Y') }}
                            </span>
                            <span class="text-blue-600 dark:text-blue-400 text-sm font-medium">Read More →</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 dark:text-gray-400 text-lg">No blog posts yet</p>
                </div>
            @endforelse
        </div>

        @if($blogs->hasPages())
            <div class="mt-12">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
