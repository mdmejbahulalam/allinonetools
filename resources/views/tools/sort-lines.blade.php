@extends('layouts.app')

@section('title', 'Sort Lines - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Sort Lines</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Sort Lines</h1>

            <div x-data="lineSorter()" class="space-y-6">
                <div class="flex gap-4">
                    <label class="flex items-center gap-2">
                        <input type="radio" x-model="order" value="asc" @change="sort()" class="cursor-pointer">
                        <span class="text-gray-700 dark:text-gray-300">Ascending</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" x-model="order" value="desc" @change="sort()" class="cursor-pointer">
                        <span class="text-gray-700 dark:text-gray-300">Descending</span>
                    </label>
                    <label class="flex items-center gap-2 ml-4">
                        <input type="checkbox" x-model="caseInsensitive" @change="sort()" class="cursor-pointer">
                        <span class="text-gray-700 dark:text-gray-300">Case-insensitive</span>
                    </label>
                </div>

                <textarea
                    x-model="input"
                    @input="sort()"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-mono text-sm"
                    rows="8"
                    placeholder="Enter lines to sort..."
                ></textarea>

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white min-h-32 font-mono text-sm whitespace-pre-wrap">
                    <code x-text="output"></code>
                </div>

                <button @click="navigator.clipboard.writeText(output)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                    Copy
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function lineSorter() {
    return {
        input: '',
        output: '',
        order: 'asc',
        caseInsensitive: false,

        sort() {
            const lines = this.input.split('\n');
            const sorted = [...lines].sort((a, b) => {
                const aVal = this.caseInsensitive ? a.toLowerCase() : a;
                const bVal = this.caseInsensitive ? b.toLowerCase() : b;

                if (this.order === 'asc') {
                    return aVal.localeCompare(bVal);
                } else {
                    return bVal.localeCompare(aVal);
                }
            });

            this.output = sorted.join('\n');
        }
    }
}
</script>

<div x-data="lineSorter()"></div>
@endsection
