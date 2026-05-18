@extends('layouts.app')

@section('title', 'UUID Generator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">UUID Generator</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">UUID Generator</h1>

            <div x-data="uuidGenerator()" class="space-y-6">
                <div class="space-y-3" x-show="uuids.length">
                    <template x-for="(uuid, index) in uuids" :key="index">
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white font-mono flex justify-between items-center">
                            <code x-text="uuid" class="flex-1"></code>
                            <button @click="navigator.clipboard.writeText(uuid)" class="ml-4 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                Copy
                            </button>
                        </div>
                    </template>
                </div>

                <div class="flex gap-4">
                    <button @click="generate()" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded-lg transition">
                        Generate UUID
                    </button>
                    <button @click="clear()" class="flex-1 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-900 dark:text-white font-medium py-2 rounded-lg transition">
                        Clear
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function uuidGenerator() {
    return {
        uuids: [],

        generate() {
            const uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                const r = Math.random() * 16 | 0;
                const v = c === 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
            this.uuids.push(uuid);
        },

        clear() {
            this.uuids = [];
        }
    }
}
</script>

<div x-data="uuidGenerator()"></div>
@endsection
