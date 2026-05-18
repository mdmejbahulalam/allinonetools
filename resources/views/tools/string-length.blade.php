@extends('layouts.app')

@section('title', 'String Length Calculator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">String Length</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">String Length Calculator</h1>

            <div x-data="{ input: '', length: 0 }" class="space-y-6">
                <textarea
                    x-model="input"
                    @input="length = input.length"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    rows="8"
                    placeholder="Enter text..."
                ></textarea>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <p class="text-sm text-blue-600 dark:text-blue-400">Total Characters</p>
                        <p class="text-3xl font-bold text-blue-900 dark:text-blue-300" x-text="length"></p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <p class="text-sm text-green-600 dark:text-green-400">Without Spaces</p>
                        <p class="text-3xl font-bold text-green-900 dark:text-green-300" x-text="input.replace(/\s/g, '').length"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
