@extends('layouts.app')

@section('title', 'Duplicate Line Remover - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Duplicate Line Remover</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Duplicate Line Remover</h1>

            <div x-data="duplicateRemover()" class="space-y-6">
                <textarea
                    x-model="input"
                    @input="removeDuplicates()"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-mono text-sm"
                    rows="8"
                    placeholder="Enter lines of text..."
                ></textarea>

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white min-h-32 font-mono text-sm whitespace-pre-wrap">
                    <code x-text="output"></code>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <p class="text-sm text-blue-600 dark:text-blue-400">Original Lines</p>
                        <p class="text-2xl font-bold text-blue-900 dark:text-blue-300" x-text="originalCount"></p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <p class="text-sm text-green-600 dark:text-green-400">Unique Lines</p>
                        <p class="text-2xl font-bold text-green-900 dark:text-green-300" x-text="uniqueCount"></p>
                    </div>
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                        <p class="text-sm text-red-600 dark:text-red-400">Removed</p>
                        <p class="text-2xl font-bold text-red-900 dark:text-red-300" x-text="removedCount"></p>
                    </div>
                </div>

                <button @click="navigator.clipboard.writeText(output)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                    Copy
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function duplicateRemover() {
    return {
        input: '',
        output: '',
        originalCount: 0,
        uniqueCount: 0,
        removedCount: 0,

        removeDuplicates() {
            const lines = this.input.split('\n');
            this.originalCount = lines.length;
            const seen = new Set();
            const unique = [];

            lines.forEach(line => {
                if (!seen.has(line)) {
                    seen.add(line);
                    unique.push(line);
                }
            });

            this.uniqueCount = unique.length;
            this.removedCount = this.originalCount - this.uniqueCount;
            this.output = unique.join('\n');
        }
    }
}
</script>

<div x-data="duplicateRemover()"></div>
@endsection
