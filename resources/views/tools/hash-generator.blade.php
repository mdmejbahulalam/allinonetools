@extends('layouts.app')

@section('title', 'Hash Generator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Hash Generator</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Hash Generator</h1>

            <div x-data="{ input: '', md5: '', sha1: '', sha256: '' }" class="space-y-6">
                <textarea
                    x-model="input"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    rows="4"
                    placeholder="Enter text to hash..."
                ></textarea>

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">SHA-256</p>
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-2 rounded font-mono text-sm text-gray-900 dark:text-white break-all">
                            <span x-text="sha256 || 'Generate hashes first'"></span>
                        </div>
                    </div>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Note: Hash generation requires server-side processing for security. This tool demonstrates the concept with client-side limitations.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
