@extends('layouts.app')

@section('title', 'Edit Blog Post - Admin')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('admin.blogs.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Blog Posts</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Edit</span>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Edit Blog Post</h1>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                    <ul class="text-red-800 dark:text-red-300 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title *</label>
                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $blog->title) }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            required
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Slug *</label>
                        <input
                            type="text"
                            name="slug"
                            value="{{ old('slug', $blog->slug) }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            required
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Excerpt *</label>
                    <textarea
                        name="excerpt"
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        required
                    >{{ old('excerpt', $blog->excerpt) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content *</label>
                    <textarea
                        name="content"
                        rows="10"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-mono text-sm"
                        required
                    >{{ old('content', $blog->content) }}</textarea>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Supports basic HTML and Markdown</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status *</label>
                        <select
                            name="status"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            required
                        >
                            <option value="draft" {{ old('status', $blog->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $blog->status) === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $blog->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Published Date</label>
                        <input
                            type="date"
                            name="published_at"
                            value="{{ old('published_at', $blog->published_at?->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Featured Image URL</label>
                    <input
                        type="text"
                        name="featured_image"
                        value="{{ old('featured_image', $blog->featured_image) }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Title</label>
                    <input
                        type="text"
                        name="meta_title"
                        value="{{ old('meta_title', $blog->meta_title) }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        maxlength="255"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Meta Description</label>
                    <textarea
                        name="meta_description"
                        rows="2"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        maxlength="255"
                    >{{ old('meta_description', $blog->meta_description) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Keywords</label>
                    <input
                        type="text"
                        name="keywords"
                        value="{{ old('keywords', $blog->keywords) }}"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        placeholder="Comma-separated keywords"
                    />
                </div>

                <div class="flex gap-4 pt-4">
                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition"
                    >
                        Update Blog Post
                    </button>
                    <a
                        href="{{ route('admin.blogs.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-3 px-6 rounded-lg transition"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
