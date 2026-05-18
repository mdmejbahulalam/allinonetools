@extends('layouts.app')

@section('title', 'Text Search & Replace - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Text Search & Replace</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Text Search & Replace</h1>

            <div x-data="searchReplace()" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Original Text</label>
                    <textarea
                        x-model="input"
                        @input="replace()"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        rows="6"
                        placeholder="Enter text..."
                    ></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Find</label>
                        <input
                            x-model="search"
                            @input="replace()"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder="Text to find..."
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Replace With</label>
                        <input
                            x-model="replaceWith"
                            @input="replace()"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder="Replacement text..."
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Result</label>
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white min-h-32 whitespace-pre-wrap">
                        <code x-text="output"></code>
                    </div>
                </div>

                <button @click="navigator.clipboard.writeText(output)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                    Copy Result
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function searchReplace() {
    return {
        input: '',
        search: '',
        replaceWith: '',
        output: '',

        replace() {
            if (!this.search) {
                this.output = this.input;
                return;
            }
            this.output = this.input.replaceAll(this.search, this.replaceWith);
        }
    }
}
</script>

<div x-data="searchReplace()"></div>
@endsection
