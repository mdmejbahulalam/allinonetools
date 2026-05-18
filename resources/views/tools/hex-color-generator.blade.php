@extends('layouts.app')

@section('title', 'Random HEX Color Generator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">HEX Color Generator</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Random HEX Color Generator</h1>

            <div x-data="colorGenerator()" class="space-y-6">
                <div class="bg-gray-50 dark:bg-gray-700 p-12 rounded-lg border-2 border-gray-300 dark:border-gray-600 flex flex-col items-center justify-center">
                    <div :style="'background-color: ' + color" class="w-32 h-32 rounded-lg mb-4 shadow-lg"></div>
                    <code class="text-2xl font-mono text-gray-900 dark:text-white" x-text="color"></code>
                </div>

                <div class="flex gap-4">
                    <button @click="generate()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                        Generate
                    </button>
                    <button @click="navigator.clipboard.writeText(color)" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded-lg transition">
                        Copy
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function colorGenerator() {
    return {
        color: '#FF5733',

        generate() {
            this.color = '#' + Math.floor(Math.random()*16777215).toString(16).toUpperCase().padStart(6, '0');
        }
    }
}
</script>

<div x-data="colorGenerator()"></div>
@endsection
