@extends('layouts.app')

@section('title', 'Lorem Ipsum Generator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Lorem Ipsum Generator</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Lorem Ipsum Generator</h1>

            <div x-data="loremGenerator()" class="space-y-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
                        <select
                            x-model="type"
                            @change="generate()"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        >
                            <option value="paragraphs">Paragraphs</option>
                            <option value="sentences">Sentences</option>
                            <option value="words">Words</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Count</label>
                        <input
                            x-model.number="count"
                            @change="generate()"
                            type="number"
                            min="1"
                            max="100"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        />
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white min-h-32 whitespace-pre-wrap">
                    <p x-text="output"></p>
                </div>

                <button @click="navigator.clipboard.writeText(output)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                    Copy
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function loremGenerator() {
    return {
        type: 'paragraphs',
        count: 3,
        output: '',

        words: ['lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit',
            'sed', 'do', 'eiusmod', 'tempor', 'incididunt', 'ut', 'labore', 'et', 'dolore',
            'magna', 'aliqua', 'enim', 'ad', 'minim', 'veniam', 'quis', 'nostrud', 'exercitation',
            'ullamco', 'laboris', 'nisi', 'aliquip', 'ex', 'ea', 'commodo', 'consequat'],

        randomWord() {
            return this.words[Math.floor(Math.random() * this.words.length)];
        },

        generateSentence() {
            const length = Math.floor(Math.random() * 8) + 4;
            const words = [];
            for (let i = 0; i < length; i++) {
                words.push(this.randomWord());
            }
            return words[0].charAt(0).toUpperCase() + words[0].slice(1) + ' ' + words.slice(1).join(' ') + '.';
        },

        generateParagraph() {
            const length = Math.floor(Math.random() * 5) + 4;
            const sentences = [];
            for (let i = 0; i < length; i++) {
                sentences.push(this.generateSentence());
            }
            return sentences.join(' ');
        },

        generate() {
            if (this.type === 'paragraphs') {
                const paragraphs = [];
                for (let i = 0; i < this.count; i++) {
                    paragraphs.push(this.generateParagraph());
                }
                this.output = paragraphs.join('\n\n');
            } else if (this.type === 'sentences') {
                const sentences = [];
                for (let i = 0; i < this.count; i++) {
                    sentences.push(this.generateSentence());
                }
                this.output = sentences.join(' ');
            } else {
                const words = [];
                for (let i = 0; i < this.count; i++) {
                    words.push(this.randomWord());
                }
                this.output = words.join(', ');
            }
        }
    }
}
</script>

<div x-data="loremGenerator()" x-init="generate()"></div>
@endsection
