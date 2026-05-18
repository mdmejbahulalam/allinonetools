@extends('layouts.app')

@section('title', 'Blog Posts - Admin')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Admin</a>
                <span class="text-gray-400"> / </span>
                <span class="text-gray-900 dark:text-white">Blog Posts</span>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Blog Posts</h1>
                <a href="{{ route('admin.blogs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                    Add Blog Post
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-300 dark:border-gray-600">
                            <th class="text-left px-4 py-3 text-gray-700 dark:text-gray-300">Title</th>
                            <th class="text-left px-4 py-3 text-gray-700 dark:text-gray-300">Author</th>
                            <th class="text-left px-4 py-3 text-gray-700 dark:text-gray-300">Status</th>
                            <th class="text-left px-4 py-3 text-gray-700 dark:text-gray-300">Published</th>
                            <th class="text-left px-4 py-3 text-gray-700 dark:text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 text-gray-900 dark:text-white">{{ $blog->title }}</td>
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $blog->author->name ?? 'Unknown' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                        @if($blog->status === 'published')
                                            bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-300
                                        @elseif($blog->status === 'draft')
                                            bg-yellow-100 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-300
                                        @else
                                            bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300
                                        @endif
                                    ">
                                        {{ ucfirst($blog->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                                    {{ $blog->published_at ? $blog->published_at->format('M d, Y') : '—' }}
                                </td>
                                <td class="px-4 py-3 space-x-2">
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" class="inline" onsubmit="return confirm('Delete this blog post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-600 dark:text-gray-400">
                                    No blog posts yet. <a href="{{ route('admin.blogs.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Create one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($blogs->hasPages())
                <div class="mt-6">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
