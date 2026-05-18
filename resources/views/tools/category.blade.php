@extends('layouts.app')

@section('title', $category->meta_title ?? $category->name . ' Tools')
@section('meta_description', $category->meta_description ?? Str::limit($category->description, 160))

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "{{ $category->name }}",
  "description": "{{ $category->description }}",
  "url": "{{ url()->current() }}"
}
</script>
@endpush

@section('content')
<!-- Breadcrumb -->
<nav class="mb-8 flex items-center gap-2 text-sm">
    <a href="/" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
    <span class="text-gray-400">/</span>
    <span class="text-gray-600 dark:text-gray-400">{{ $category->name }}</span>
</nav>

<div class="mb-8">
    <div class="flex items-center gap-4 mb-4">
        <div class="text-4xl">{{ $category->icon ?? '📦' }}</div>
        <div>
            <h1 class="text-4xl font-bold">{{ $category->name }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ $category->description }}</p>
        </div>
    </div>
</div>

<!-- Tools Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
    @forelse($tools as $tool)
    <a href="/{{ $tool->slug }}" class="block p-6 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:shadow-lg dark:hover:shadow-xl hover:border-blue-500 dark:hover:border-blue-400 transition-all">
        <h3 class="font-bold text-lg mb-2">{{ $tool->title }}</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $tool->description }}</p>
        <div class="flex justify-between items-center">
            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $tool->views }} views</span>
            <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">Open →</span>
        </div>
    </a>
    @empty
    <div class="col-span-full text-center py-12">
        <p class="text-gray-600 dark:text-gray-400">No tools in this category yet.</p>
    </div>
    @endforelse
</div>

<!-- Pagination -->
{{ $tools->links() }}

@endsection
