@extends('layouts.app')

@section('title', 'Case Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Case Converter</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Case Converter</h1>

            <div x-data="caseConverter()" class="space-y-6">
                <textarea
                    x-model="input"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    rows="4"
                    placeholder="Enter text..."
                ></textarea>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">UPPERCASE</p>
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 rounded border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white break-all">
                            <code x-text="input.toUpperCase()"></code>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">lowercase</p>
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 rounded border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white break-all">
                            <code x-text="input.toLowerCase()"></code>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Title Case</p>
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 rounded border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white break-all">
                            <code x-text="titleCase()"></code>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Sentence case</p>
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 rounded border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white break-all">
                            <code x-text="sentenceCase()"></code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function caseConverter() {
    return {
        input: '',

        titleCase() {
            return this.input.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()).join(' ');
        },

        sentenceCase() {
            return this.input.charAt(0).toUpperCase() + this.input.slice(1).toLowerCase();
        }
    }
}
</script>

<div x-data="caseConverter()"></div>
@endsection
