@extends('layouts.app')

@section('title', 'Remove Duplicates - Remove Duplicate Lines')
@section('meta_description', 'Remove duplicate lines from text instantly. Keep unique lines only.')

@section('content')
<nav class="mb-8 flex items-center gap-2 text-sm">
    <a href="/" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
    <span class="text-gray-400">/</span>
    <span class="text-gray-600 dark:text-gray-400">Remove Duplicates</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <h1 class="text-4xl font-bold mb-4">Remove Duplicates</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Remove duplicate lines from your text instantly.</p>

        <div x-data="removeDuplicates()" class="space-y-6">
            <!-- Options -->
            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                <label class="flex items-center gap-2">
                    <input type="checkbox" x-model="caseSensitive" @change="process()" class="w-4 h-4">
                    <span>Case Sensitive</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" x-model="ignoreEmpty" @change="process()" class="w-4 h-4">
                    <span>Ignore Empty Lines</span>
                </label>
            </div>

            <!-- Input Area -->
            <div>
                <label class="block font-semibold mb-2">Original Text (one item per line)</label>
                <textarea
                    x-model="input"
                    @input="process()"
                    placeholder="Enter lines separated by line breaks..."
                    class="w-full h-48 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
                <div class="mt-2 flex gap-2">
                    <button @click="reset()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Clear</button>
                    <button @click="loadExample()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Load Example</button>
                </div>
            </div>

            <!-- Output Area -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="block font-semibold">Unique Lines</label>
                    <button @click="copyOutput()" class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                        📋 Copy
                    </button>
                </div>
                <textarea
                    x-model="output"
                    readonly
                    class="w-full h-48 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 font-mono text-sm focus:outline-none"
                ></textarea>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-blue-50 dark:bg-gray-800 p-4 rounded">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Original Lines</div>
                    <div class="text-2xl font-bold" x-text="stats.original"></div>
                </div>
                <div class="bg-green-50 dark:bg-gray-800 p-4 rounded">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Unique Lines</div>
                    <div class="text-2xl font-bold" x-text="stats.unique"></div>
                </div>
                <div class="bg-red-50 dark:bg-gray-800 p-4 rounded">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Duplicates Removed</div>
                    <div class="text-2xl font-bold" x-text="stats.removed"></div>
                </div>
            </div>
        </div>

        <div class="mt-12 space-y-6">
            <div>
                <h2 class="text-2xl font-bold mb-4">How to Use</h2>
                <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
                    <li>Paste your text with multiple lines</li>
                    <li>Each line will be checked for duplicates</li>
                    <li>Only the first occurrence of each unique line is kept</li>
                    <li>Click "Copy" to copy the cleaned result</li>
                </ol>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-4">Use Cases</h2>
                <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Remove duplicate URLs, emails, or usernames</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Clean up lists and datasets</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Remove duplicate log entries</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Deduplicate CSV data</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <aside>
        <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-6 border border-blue-200 dark:border-gray-700 sticky top-20">
            <h3 class="font-bold mb-4">Related Tools</h3>
            <div class="space-y-2">
                <a href="/trim-whitespace" class="block p-3 bg-white dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="font-semibold text-sm">Trim Whitespace</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Remove extra spaces</div>
                </a>
                <a href="/word-counter" class="block p-3 bg-white dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="font-semibold text-sm">Word Counter</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Count words & lines</div>
                </a>
            </div>
        </div>
    </aside>
</div>

<script>
function removeDuplicates() {
    return {
        input: '',
        output: '',
        caseSensitive: false,
        ignoreEmpty: false,
        stats: {
            original: 0,
            unique: 0,
            removed: 0
        },

        process() {
            const lines = this.input.split('\n');
            const seen = new Set();
            const unique = [];

            for (const line of lines) {
                const compare = this.caseSensitive ? line : line.toLowerCase();

                if (this.ignoreEmpty && !line.trim()) {
                    unique.push(line);
                    continue;
                }

                if (!seen.has(compare)) {
                    seen.add(compare);
                    unique.push(line);
                }
            }

            this.output = unique.join('\n');
            this.stats.original = lines.length;
            this.stats.unique = unique.length;
            this.stats.removed = lines.length - unique.length;
        },

        reset() {
            this.input = '';
            this.output = '';
            this.process();
        },

        loadExample() {
            this.input = `apple
banana
apple
cherry
banana
date
apple`;
            this.process();
        },

        copyOutput() {
            navigator.clipboard.writeText(this.output).then(() => {
                alert('Copied to clipboard!');
            });
        }
    };
}
</script>
@endsection
