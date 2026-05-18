@extends('layouts.app')

@section('title', 'List Randomizer - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">List Randomizer</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">List Randomizer</h1>

            <div x-data="listRandomizer()" class="space-y-6">
                <textarea
                    x-model="input"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-mono text-sm"
                    rows="8"
                    placeholder="Enter items (one per line)..."
                ></textarea>

                <div class="flex gap-2">
                    <button @click="shuffle()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                        Shuffle
                    </button>
                    <button @click="pickRandom()" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded-lg transition">
                        Pick Random
                    </button>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white min-h-32 font-mono text-sm whitespace-pre-wrap">
                    <code x-text="output || '(result will appear here)'"></code>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <p class="text-sm text-blue-600 dark:text-blue-400">Total Items</p>
                        <p class="text-2xl font-bold text-blue-900 dark:text-blue-300" x-text="itemCount"></p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <p class="text-sm text-green-600 dark:text-green-400">Selected</p>
                        <p class="text-2xl font-bold text-green-900 dark:text-green-300" x-text="selected"></p>
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
function listRandomizer() {
    return {
        input: '',
        output: '',
        itemCount: 0,
        selected: '',

        getItems() {
            return this.input.split('\n').filter(line => line.trim() !== '');
        },

        shuffle() {
            const items = this.getItems();
            this.itemCount = items.length;

            for (let i = items.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [items[i], items[j]] = [items[j], items[i]];
            }

            this.output = items.join('\n');
            this.selected = 'Shuffled';
        },

        pickRandom() {
            const items = this.getItems();
            this.itemCount = items.length;

            if (items.length === 0) {
                this.output = '';
                this.selected = '';
                return;
            }

            const selected = items[Math.floor(Math.random() * items.length)];
            this.output = selected;
            this.selected = '1 item';
        }
    }
}
</script>

<div x-data="listRandomizer()"></div>
@endsection
