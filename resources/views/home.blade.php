@extends('layouts.app')

@section('title', 'Free Online Utility Tools')
@section('meta_description', 'Free online tools for text conversion, formatting, encoding, and much more. JSON formatter, base64 encoder, case converter, and 100+ tools.')

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebApplication",
  "name": "Utility Tools",
  "url": "{{ url('/') }}",
  "applicationCategory": "Productivity",
  "description": "Free online utility tools for developers and content creators"
}
</script>
@endpush

@section('content')
<!-- Hero Section -->
<div class="mb-16">
    <div class="text-center">
        <h1 class="text-5xl font-bold mb-4">Your All-in-One Tool Suite</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">500+ free online tools to convert, format, encode, and transform your content instantly.</p>
    </div>
</div>

<!-- Top Tools Grid -->
<div class="mb-16">
    <h2 class="text-3xl font-bold mb-8">Popular Tools</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($topTools as $tool)
        <a href="/{{ $tool->slug }}" class="block p-6 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-xl hover:border-blue-500 dark:hover:border-blue-400 transition-all">
            <h3 class="font-bold text-lg mb-2">{{ $tool->title }}</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ Str::limit($tool->description, 60) }}</p>
            <div class="flex justify-between items-center">
                <span class="text-xs bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-2 py-1 rounded">
                    {{ $tool->category->name }}
                </span>
                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $tool->views }} views</span>
            </div>
        </a>
        @endforeach
    </div>
</div>

<!-- Categories Section -->
<div class="mb-16">
    <h2 class="text-3xl font-bold mb-8">Browse by Category</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
        <a href="/category/{{ $category->slug }}" class="block p-6 bg-gradient-to-br from-blue-50 to-blue-100 dark:from-gray-800 dark:to-gray-900 rounded-lg border border-blue-200 dark:border-gray-700 hover:shadow-lg transition-all">
            <div class="text-3xl mb-3">{{ $category->icon ?? '📦' }}</div>
            <h3 class="font-bold text-lg mb-2">{{ $category->name }}</h3>
            <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">{{ $category->description ?? 'Tools in this category' }}</p>
            <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">{{ $category->tools->count() }} tools →</span>
        </a>
        @endforeach
    </div>
</div>

<!-- Features Section -->
<div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-8 mb-16">
    <h2 class="text-3xl font-bold mb-8 text-center">Why Choose Utility Tools?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="text-center">
            <div class="text-4xl mb-4">⚡</div>
            <h3 class="font-bold mb-2">Instant Processing</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">All tools work instantly without server calls—your data stays private.</p>
        </div>
        <div class="text-center">
            <div class="text-4xl mb-4">🛡️</div>
            <h3 class="font-bold mb-2">Privacy First</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Your data never leaves your browser. No tracking, no logging.</p>
        </div>
        <div class="text-center">
            <div class="text-4xl mb-4">💯</div>
            <h3 class="font-bold mb-2">100% Free</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">No ads, no subscriptions, no hidden fees. Forever free.</p>
        </div>
    </div>
</div>

@endsection
