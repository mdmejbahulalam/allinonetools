@extends('layouts.app')

@section('title', 'Base64 Decoder - Decode Online')
@section('meta_description', 'Decode Base64 text and strings instantly. Fast and secure decoding in your browser.')

@section('content')
<nav class="mb-8 flex items-center gap-2 text-sm">
    <a href="/" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
    <span class="text-gray-400">/</span>
    <span class="text-gray-600 dark:text-gray-400">Base64 Decoder</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <h1 class="text-4xl font-bold mb-4">Base64 Decoder</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Decode Base64 encoded text back to original format instantly.</p>

        <div x-data="base64Decoder()" class="space-y-6">
            <!-- Input Area -->
            <div>
                <label class="block font-semibold mb-2">Base64 Encoded Text</label>
                <textarea
                    x-model="input"
                    @input="decode()"
                    placeholder="Paste Base64 encoded text..."
                    class="w-full h-48 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
                <div class="mt-2 flex gap-2">
                    <button @click="reset()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Reset</button>
                    <button @click="loadExample()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Load Example</button>
                </div>
                <div x-show="error" class="mt-2 p-3 bg-red-100 dark:bg-red-900 border border-red-400 text-red-700 dark:text-red-200 rounded">
                    <strong>Error:</strong> Invalid Base64 format
                </div>
            </div>

            <!-- Output Area -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="block font-semibold">Decoded Text</label>
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
                    <div class="text-sm text-gray-600 dark:text-gray-400">Encoded Size</div>
                    <div class="text-2xl font-bold" x-text="`${input.length} chars`"></div>
                </div>
                <div class="bg-blue-50 dark:bg-gray-800 p-4 rounded">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Decoded Size</div>
                    <div class="text-2xl font-bold" x-text="`${output.length} chars`"></div>
                </div>
            </div>
        </div>

        <div class="mt-12 space-y-6">
            <div>
                <h2 class="text-2xl font-bold mb-4">When to Use</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Decode Base64 when you need to:</p>
                <ul class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-400">
                    <li>Read encoded email attachments</li>
                    <li>View embedded images in HTML/CSS</li>
                    <li>Decode API authentication tokens</li>
                    <li>Retrieve data from data URLs</li>
                </ul>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-4">How to Use</h2>
                <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
                    <li>Paste your Base64 text in the input field</li>
                    <li>It decodes instantly as you type</li>
                    <li>Click "Copy" to copy the decoded result</li>
                    <li>Use the decoded text as needed</li>
                </ol>
            </div>
        </div>
    </div>

    <aside>
        <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-6 border border-blue-200 dark:border-gray-700 sticky top-20">
            <h3 class="font-bold mb-4">Related Tools</h3>
            <div class="space-y-2">
                <a href="/base64-encoder" class="block p-3 bg-white dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="font-semibold text-sm">Base64 Encoder</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Encode to Base64</div>
                </a>
                <a href="/url-encoder" class="block p-3 bg-white dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="font-semibold text-sm">URL Encoder</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Encode URLs</div>
                </a>
            </div>
        </div>
    </aside>
</div>

<script>
function base64Decoder() {
    return {
        input: '',
        output: '',
        error: false,

        decode() {
            try {
                this.error = false;
                if (!this.input.trim()) {
                    this.output = '';
                    return;
                }
                this.output = decodeURIComponent(escape(atob(this.input)));
            } catch (e) {
                this.error = true;
                this.output = '';
            }
        },

        reset() {
            this.input = '';
            this.output = '';
            this.error = false;
        },

        loadExample() {
            this.input = 'SGVsbG8sIFdvcmxkISBUaGlzIGlzIEJhc2U2NCBkZWNvZGluZy4=';
            this.decode();
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
