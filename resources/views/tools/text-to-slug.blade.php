@extends('layouts.app')

@section('title', 'Text to Slug Converter - ' . config('app.name'))
@section('meta_description', 'Convert any text into URL-friendly slugs. Perfect for creating URLs, file names, and identifiers.')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Breadcrumb -->
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('category', 'text-converters') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Text Converters</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white">Text to Slug</span>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Text to Slug Converter</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Convert any text into URL-friendly slugs instantly</p>

                    <div x-data="textToSlug()" class="space-y-6">
                        <!-- Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Input Text
                            </label>
                            <textarea
                                x-model="input"
                                @input="convert()"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                rows="4"
                                placeholder="Enter text to convert to slug..."
                            ></textarea>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                                Characters: <span x-text="input.length"></span>
                            </div>
                        </div>

                        <!-- Options -->
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" x-model="keepNumbers" @change="convert()" class="w-4 h-4">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Keep Numbers</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" x-model="lowercase" checked @change="convert()" class="w-4 h-4">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Lowercase</span>
                            </label>
                        </div>

                        <!-- Output -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Slug Output
                            </label>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white break-all">
                                <code x-text="output"></code>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-4">
                            <button @click="copyToClipboard()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                                Copy Slug
                            </button>
                            <button @click="reset()" class="flex-1 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-900 dark:text-white font-medium py-2 rounded-lg transition">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Info Box -->
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-blue-900 dark:text-blue-300 mb-2">💡 What is a Slug?</h3>
                    <p class="text-sm text-blue-800 dark:text-blue-400">A slug is a URL-friendly version of text. It contains only lowercase letters, numbers, and hyphens, making it suitable for web URLs.</p>
                </div>

                <!-- Related Tools -->
                <h3 class="font-bold text-gray-900 dark:text-white mb-4">Related Tools</h3>
                <div class="space-y-2">
                    <a href="{{ route('tool.show', 'camelcase-converter') }}" class="block p-3 bg-white dark:bg-gray-800 rounded hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm transition">
                        → CamelCase Converter
                    </a>
                    <a href="{{ route('tool.show', 'snake-case-converter') }}" class="block p-3 bg-white dark:bg-gray-800 rounded hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm transition">
                        → Snake_case Converter
                    </a>
                    <a href="{{ route('tool.show', 'url-encoder') }}" class="block p-3 bg-white dark:bg-gray-800 rounded hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm transition">
                        → URL Encoder/Decoder
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function textToSlug() {
    return {
        input: '',
        output: '',
        keepNumbers: true,
        lowercase: true,

        convert() {
            let slug = this.input.trim();

            if (this.lowercase) {
                slug = slug.toLowerCase();
            }

            slug = slug
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');

            if (!this.keepNumbers) {
                slug = slug.replace(/\d+/g, '');
            }

            this.output = slug;
        },

        copyToClipboard() {
            if (this.output) {
                navigator.clipboard.writeText(this.output);
                alert('Slug copied to clipboard!');
            }
        },

        reset() {
            this.input = '';
            this.output = '';
        }
    }
}
</script>
@endsection
