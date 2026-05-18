@extends('layouts.app')

@section('title', 'Lowercase Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Lowercase Converter</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Lowercase Converter</h1>

            <div x-data="{ input: '', output: '' }" class="space-y-6">
                <textarea
                    x-model="input"
                    @input="output = input.toLowerCase()"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    rows="6"
                    placeholder="Enter text..."
                ></textarea>

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white min-h-24">
                    <code x-text="output"></code>
                </div>

                <div class="flex gap-4">
                    <button @click="navigator.clipboard.writeText(output)" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                        Copy
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
