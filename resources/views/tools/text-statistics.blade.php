@extends('layouts.app')

@section('title', 'Text Statistics - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Text Statistics</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Text Statistics</h1>

            <div x-data="textStats()" class="space-y-6">
                <textarea
                    x-model="input"
                    @input="calculate()"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    rows="8"
                    placeholder="Enter text..."
                ></textarea>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <p class="text-sm text-blue-600 dark:text-blue-400">Characters</p>
                        <p class="text-2xl font-bold text-blue-900 dark:text-blue-300" x-text="chars"></p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <p class="text-sm text-green-600 dark:text-green-400">Words</p>
                        <p class="text-2xl font-bold text-green-900 dark:text-green-300" x-text="words"></p>
                    </div>
                    <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg p-4">
                        <p class="text-sm text-purple-600 dark:text-purple-400">Lines</p>
                        <p class="text-2xl font-bold text-purple-900 dark:text-purple-300" x-text="lines"></p>
                    </div>
                    <div class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 rounded-lg p-4">
                        <p class="text-sm text-orange-600 dark:text-orange-400">Paragraphs</p>
                        <p class="text-2xl font-bold text-orange-900 dark:text-orange-300" x-text="paragraphs"></p>
                    </div>
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                        <p class="text-sm text-red-600 dark:text-red-400">Spaces</p>
                        <p class="text-2xl font-bold text-red-900 dark:text-red-300" x-text="spaces"></p>
                    </div>
                    <div class="bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800 rounded-lg p-4">
                        <p class="text-sm text-indigo-600 dark:text-indigo-400">Avg Word Length</p>
                        <p class="text-2xl font-bold text-indigo-900 dark:text-indigo-300" x-text="avgWordLength"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function textStats() {
    return {
        input: '',
        chars: 0,
        words: 0,
        lines: 0,
        paragraphs: 0,
        spaces: 0,
        avgWordLength: 0,

        calculate() {
            this.chars = this.input.length;
            this.words = this.input.trim() ? this.input.trim().split(/\s+/).length : 0;
            this.lines = this.input ? this.input.split('\n').length : 0;
            this.paragraphs = this.input.trim() ? this.input.trim().split(/\n\n+/).length : 0;
            this.spaces = (this.input.match(/ /g) || []).length;
            this.avgWordLength = this.words > 0 ? (this.input.replace(/\s/g, '').length / this.words).toFixed(1) : 0;
        }
    }
}
</script>

<div x-data="textStats()"></div>
@endsection
