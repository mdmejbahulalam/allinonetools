@extends('layouts.app')

@section('title', 'Trim Whitespace - Remove Extra Spaces')
@section('meta_description', 'Remove leading, trailing, and extra spaces from text instantly.')

@section('content')
<nav class="mb-8 flex items-center gap-2 text-sm">
    <a href="/" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
    <span class="text-gray-400">/</span>
    <span class="text-gray-600 dark:text-gray-400">Trim Whitespace</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <h1 class="text-4xl font-bold mb-4">Trim Whitespace</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Remove leading, trailing, and extra spaces from your text.</p>

        <div x-data="trimWhitespace()" class="space-y-6">
            <!-- Options -->
            <div class="flex flex-wrap items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                <label class="flex items-center gap-2">
                    <input type="checkbox" x-model="trimStart" @change="process()" class="w-4 h-4">
                    <span>Trim Start</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" x-model="trimEnd" @change="process()" class="w-4 h-4">
                    <span>Trim End</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" x-model="trimLines" @change="process()" class="w-4 h-4">
                    <span>Trim Each Line</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" x-model="removeExtra" @change="process()" class="w-4 h-4">
                    <span>Remove Extra Spaces</span>
                </label>
            </div>

            <!-- Input Area -->
            <div>
                <label class="block font-semibold mb-2">Original Text</label>
                <textarea
                    x-model="input"
                    @input="process()"
                    placeholder="Paste text with extra spaces..."
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
                    <label class="block font-semibold">Trimmed Text</label>
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
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-50 dark:bg-gray-800 p-4 rounded">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Original Size</div>
                    <div class="text-2xl font-bold" x-text="`${input.length} chars`"></div>
                </div>
                <div class="bg-green-50 dark:bg-gray-800 p-4 rounded">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Trimmed Size</div>
                    <div class="text-2xl font-bold" x-text="`${output.length} chars`"></div>
                </div>
            </div>
        </div>

        <div class="mt-12 space-y-6">
            <div>
                <h2 class="text-2xl font-bold mb-4">How to Use</h2>
                <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
                    <li>Paste your text in the input area</li>
                    <li>Select which whitespace to trim</li>
                    <li>It processes instantly</li>
                    <li>Click "Copy" to copy the cleaned text</li>
                </ol>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-4">Trim Options</h2>
                <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                    <li><strong>Trim Start:</strong> Remove spaces at the beginning</li>
                    <li><strong>Trim End:</strong> Remove spaces at the end</li>
                    <li><strong>Trim Each Line:</strong> Remove spaces from start/end of every line</li>
                    <li><strong>Remove Extra Spaces:</strong> Replace multiple spaces with single spaces</li>
                </ul>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-4">Use Cases</h2>
                <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Clean up code with inconsistent spacing</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Format CSV and data files</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Prepare text for database entry</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Clean up pasted content from documents</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <aside>
        <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-6 border border-blue-200 dark:border-gray-700 sticky top-20">
            <h3 class="font-bold mb-4">Related Tools</h3>
            <div class="space-y-2">
                <a href="/remove-duplicates" class="block p-3 bg-white dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="font-semibold text-sm">Remove Duplicates</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Remove duplicate lines</div>
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
function trimWhitespace() {
    return {
        input: '',
        output: '',
        trimStart: true,
        trimEnd: true,
        trimLines: true,
        removeExtra: true,

        process() {
            let text = this.input;

            if (this.trimLines) {
                text = text.split('\n').map(line => line.trim()).join('\n');
            }

            if (this.removeExtra) {
                text = text.replace(/[ \t]+/g, ' ');
            }

            if (this.trimStart) {
                text = text.replace(/^[\s\n]+/, '');
            }

            if (this.trimEnd) {
                text = text.replace(/[\s\n]+$/, '');
            }

            this.output = text;
        },

        reset() {
            this.input = '';
            this.output = '';
        },

        loadExample() {
            this.input = `  hello   world

   this  has   extra   spaces

  test  `;
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
