@extends('layouts.app')

@section('title', 'Reverse Text Tool - ' . config('app.name'))
@section('meta_description', 'Reverse any text instantly. Perfect for palindrome checking and text manipulation.')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('category', 'text-converters') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Text Converters</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white">Reverse Text</span>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Reverse Text</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Reverse any text instantly</p>

                    <div x-data="reverseText()" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Input Text</label>
                            <textarea
                                x-model="input"
                                @input="reverse()"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                rows="4"
                                placeholder="Enter text to reverse..."
                            ></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Reversed Output</label>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white min-h-24 break-all">
                                <code x-text="output"></code>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button @click="copyToClipboard()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                                Copy Reversed
                            </button>
                            <button @click="reset()" class="flex-1 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-900 dark:text-white font-medium py-2 rounded-lg transition">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-blue-900 dark:text-blue-300 mb-2">🔄 What is this tool?</h3>
                    <p class="text-sm text-blue-800 dark:text-blue-400">This tool reverses the order of characters in your text. Great for checking palindromes or creating backward text.</p>
                </div>

                <h3 class="font-bold text-gray-900 dark:text-white mb-4">Related Tools</h3>
                <div class="space-y-2">
                    <a href="{{ route('tool.show', 'word-counter') }}" class="block p-3 bg-white dark:bg-gray-800 rounded hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm transition">
                        → Word Counter
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function reverseText() {
    return {
        input: '',
        output: '',

        reverse() {
            this.output = this.input.split('').reverse().join('');
        },

        copyToClipboard() {
            if (this.output) {
                navigator.clipboard.writeText(this.output);
                alert('Reversed text copied!');
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
