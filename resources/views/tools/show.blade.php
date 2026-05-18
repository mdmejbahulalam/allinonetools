@extends('layouts.app')

@section('title', $tool->meta_title ?? $tool->title)
@section('meta_description', $tool->meta_description ?? Str::limit($tool->description, 160))
@section('meta_keywords', $tool->keywords ?? '')

@push('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "{{ $tool->title }}",
  "description": "{{ $tool->description }}",
  "url": "{{ url()->current() }}",
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "{{ url('/') }}"
      },
      {
        "@type": "ListItem",
        "position": 2,
        "name": "{{ $category->name }}",
        "item": "{{ url('/category/' . $category->slug) }}"
      },
      {
        "@type": "ListItem",
        "position": 3,
        "name": "{{ $tool->title }}",
        "item": "{{ url()->current() }}"
      }
    ]
  }
  @if($faqs->count() > 0)
  ,
  "mainEntity": {
    "@type": "FAQPage",
    "mainEntity": [
      @foreach($faqs as $faq)
      {
        "@type": "Question",
        "name": "{{ $faq->question }}",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "{{ strip_tags($faq->answer) }}"
        }
      }{{ !$loop->last ? ',' : '' }}
      @endforeach
    ]
  }
  @endif
}
</script>
@endpush

@section('content')
<!-- Breadcrumb -->
<nav class="mb-8 flex items-center gap-2 text-sm">
    <a href="/" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
    <span class="text-gray-400">/</span>
    <a href="/category/{{ $category->slug }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $category->name }}</a>
    <span class="text-gray-400">/</span>
    <span class="text-gray-600 dark:text-gray-400">{{ $tool->title }}</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <h1 class="text-4xl font-bold mb-4">{{ $tool->title }}</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">{{ $tool->description }}</p>

        <!-- Tool Container -->
        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 mb-8">
            <p class="text-gray-600 dark:text-gray-400 mb-4">Tool interface will load here. For Phase 1, this is a placeholder.</p>
            <div class="bg-gray-100 dark:bg-gray-700 rounded p-4 text-center text-gray-500">
                Tool JavaScript will be injected based on blade_view column
            </div>
        </div>

        <!-- How to Use Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">How to Use</h2>
            <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
                <li>Enter your input in the text field above</li>
                <li>The tool will process instantly in your browser</li>
                <li>Copy the output using the copy button</li>
                <li>No data is ever sent to our servers</li>
            </ol>
        </div>

        <!-- Benefits Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Why Use This Tool?</h2>
            <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                <li class="flex items-start gap-2">
                    <span class="text-green-500 mt-1">✓</span>
                    <span>Instant results with no server processing</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-green-500 mt-1">✓</span>
                    <span>Your data remains completely private</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-green-500 mt-1">✓</span>
                    <span>Free to use forever, no subscriptions</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-green-500 mt-1">✓</span>
                    <span>Works offline once loaded</span>
                </li>
            </ul>
        </div>

        <!-- FAQ Section -->
        @if($faqs->count() > 0)
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Frequently Asked Questions</h2>
            <div class="space-y-4">
                @foreach($faqs as $faq)
                <details class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 cursor-pointer border border-gray-200 dark:border-gray-700">
                    <summary class="font-semibold flex justify-between items-center">
                        {{ $faq->question }}
                        <span class="text-gray-400">+</span>
                    </summary>
                    <p class="mt-3 text-gray-600 dark:text-gray-400 text-sm">{{ $faq->answer }}</p>
                </details>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <aside class="lg:col-span-1">
        <!-- Tool Info Card -->
        <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-6 mb-6 border border-blue-200 dark:border-gray-700">
            <h3 class="font-bold mb-4">Tool Information</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-gray-600 dark:text-gray-400">Category:</span>
                    <a href="/category/{{ $category->slug }}" class="block font-semibold text-blue-600 dark:text-blue-400 hover:underline">
                        {{ $category->name }}
                    </a>
                </div>
                <div>
                    <span class="text-gray-600 dark:text-gray-400">Total Views:</span>
                    <div class="font-semibold">{{ number_format($tool->views) }}</div>
                </div>
                <div>
                    <span class="text-gray-600 dark:text-gray-400">Status:</span>
                    <div class="font-semibold">
                        <span class="inline-block px-2 py-1 rounded text-white {{ $tool->status === 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ ucfirst($tool->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Tools -->
        @if($relatedTools->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="font-bold mb-4">Related Tools</h3>
            <div class="space-y-3">
                @foreach($relatedTools as $related)
                <a href="/{{ $related->slug }}" class="block p-3 bg-gray-50 dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                    <div class="font-semibold text-sm">{{ $related->title }}</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">{{ Str::limit($related->description, 50) }}</div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </aside>
</div>

@endsection
