@extends('layouts.app')

@section('title', 'Word Counter - Count Words & Characters')
@section('meta_description', 'Count words, characters, paragraphs, and sentences instantly. Free online word counter tool.')

@section('content')
<nav class="mb-8 flex items-center gap-2 text-sm">
    <a href="/" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
    <span class="text-gray-400">/</span>
    <span class="text-gray-600 dark:text-gray-400">Word Counter</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <h1 class="text-4xl font-bold mb-4">Word Counter</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Count words, characters, paragraphs, and sentences instantly.</p>

        <div x-data="wordCounter()" class="space-y-6">
            <!-- Input Area -->
            <div>
                <label class="block font-semibold mb-2">Paste Your Text</label>
                <textarea
                    x-model="text"
                    @input="count()"
                    placeholder="Paste or type your text here..."
                    class="w-full h-48 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
                <div class="mt-2">
                    <button @click="reset()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Clear</button>
                </div>
            </div>

            <!-- Statistics Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-blue-50 dark:bg-gray-800 p-6 rounded border border-blue-200 dark:border-gray-700">
                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Words</div>
                    <div class="text-4xl font-bold" x-text="stats.words"></div>
                </div>
                <div class="bg-green-50 dark:bg-gray-800 p-6 rounded border border-green-200 dark:border-gray-700">
                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Characters</div>
                    <div class="text-4xl font-bold" x-text="stats.chars"></div>
                </div>
                <div class="bg-purple-50 dark:bg-gray-800 p-6 rounded border border-purple-200 dark:border-gray-700">
                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Characters (No Spaces)</div>
                    <div class="text-4xl font-bold" x-text="stats.charsNoSpaces"></div>
                </div>
                <div class="bg-orange-50 dark:bg-gray-800 p-6 rounded border border-orange-200 dark:border-gray-700">
                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Paragraphs</div>
                    <div class="text-4xl font-bold" x-text="stats.paragraphs"></div>
                </div>
                <div class="bg-indigo-50 dark:bg-gray-800 p-6 rounded border border-indigo-200 dark:border-gray-700">
                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Sentences</div>
                    <div class="text-4xl font-bold" x-text="stats.sentences"></div>
                </div>
                <div class="bg-pink-50 dark:bg-gray-800 p-6 rounded border border-pink-200 dark:border-gray-700">
                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Lines</div>
                    <div class="text-4xl font-bold" x-text="stats.lines"></div>
                </div>
                <div class="bg-cyan-50 dark:bg-gray-800 p-6 rounded border border-cyan-200 dark:border-gray-700">
                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Avg. Word Length</div>
                    <div class="text-4xl font-bold" x-text="stats.avgWordLength"></div>
                </div>
                <div class="bg-red-50 dark:bg-gray-800 p-6 rounded border border-red-200 dark:border-gray-700">
                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">Reading Time</div>
                    <div class="text-4xl font-bold" x-text="stats.readingTime"></div>
                </div>
            </div>
        </div>

        <div class="mt-12 space-y-6">
            <div>
                <h2 class="text-2xl font-bold mb-4">How to Use</h2>
                <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
                    <li>Paste or type your text in the text area</li>
                    <li>Statistics update instantly as you type</li>
                    <li>View word count, character count, and more</li>
                    <li>Perfect for essays, articles, and social media posts</li>
                </ol>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-4">Statistics Explained</h2>
                <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                    <li><strong>Words:</strong> Total number of words (separated by spaces)</li>
                    <li><strong>Characters:</strong> Total characters including spaces</li>
                    <li><strong>Characters (No Spaces):</strong> Total characters excluding spaces</li>
                    <li><strong>Paragraphs:</strong> Blocks of text separated by line breaks</li>
                    <li><strong>Sentences:</strong> Text segments ending with . ! or ?</li>
                    <li><strong>Average Word Length:</strong> Average characters per word</li>
                    <li><strong>Reading Time:</strong> Estimated time to read (200 words/minute)</li>
                </ul>
            </div>
        </div>
    </div>

    <aside>
        <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-6 border border-blue-200 dark:border-gray-700 sticky top-20">
            <h3 class="font-bold mb-4">Tool Info</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-gray-600 dark:text-gray-400">Processing:</span>
                    <div class="font-semibold">Client-side</div>
                </div>
                <div>
                    <span class="text-gray-600 dark:text-gray-400">Privacy:</span>
                    <div class="font-semibold">100% Private</div>
                </div>
            </div>
        </div>
    </aside>
</div>

<script>
function wordCounter() {
    return {
        text: '',
        stats: {
            words: 0,
            chars: 0,
            charsNoSpaces: 0,
            paragraphs: 0,
            sentences: 0,
            lines: 0,
            avgWordLength: '0',
            readingTime: '0 min'
        },

        count() {
            const text = this.text.trim();

            this.stats.chars = this.text.length;
            this.stats.charsNoSpaces = this.text.replace(/\s/g, '').length;

            this.stats.words = text.length > 0 ? text.split(/\s+/).filter(w => w).length : 0;
            this.stats.paragraphs = text.length > 0 ? text.split(/\n\n+/).filter(p => p.trim()).length : 0;
            this.stats.sentences = text.length > 0 ? (text.match(/[.!?]/g) || []).length : 0;
            this.stats.lines = this.text.length > 0 ? this.text.split(/\n/).length : 0;

            this.stats.avgWordLength = this.stats.words > 0 ? (this.stats.charsNoSpaces / this.stats.words).toFixed(1) : '0';

            const readingMinutes = Math.ceil(this.stats.words / 200);
            this.stats.readingTime = readingMinutes === 0 ? '< 1 min' : `${readingMinutes} min`;
        },

        reset() {
            this.text = '';
            this.count();
        }
    };
}
</script>
@endsection
