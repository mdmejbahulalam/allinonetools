@extends('layouts.app')

@section('title', 'URL Validator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">URL Validator</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">URL Validator</h1>

            <div x-data="urlValidator()" class="space-y-6">
                <input
                    x-model="url"
                    @input="validate()"
                    type="text"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="Enter URL..."
                />

                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <span x-show="isValid" class="text-2xl">✓</span>
                        <span x-show="!isValid && url" class="text-2xl">✗</span>
                        <span :class="isValid && url ? 'text-green-600 dark:text-green-400' : !isValid && url ? 'text-red-600 dark:text-red-400' : 'text-gray-600 dark:text-gray-400'" x-text="status"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function urlValidator() {
    return {
        url: '',
        isValid: false,
        status: 'Enter a URL to validate',

        validate() {
            try {
                new URL(this.url);
                this.isValid = true;
                this.status = 'Valid URL';
            } catch (e) {
                this.isValid = false;
                this.status = !this.url ? 'Enter a URL to validate' : 'Invalid URL';
            }
        }
    }
}
</script>

<div x-data="urlValidator()"></div>
@endsection
