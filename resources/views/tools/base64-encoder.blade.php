@extends('layouts.app')

@section('title', 'Base64 Encoder - Encode Text Online')
@section('meta_description', 'Encode text, strings, and files to Base64 format. Instant encoding with no server processing.')

@section('content')
<nav class="mb-8 flex items-center gap-2 text-sm">
    <a href="/" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
    <span class="text-gray-400">/</span>
    <span class="text-gray-600 dark:text-gray-400">Base64 Encoder</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <h1 class="text-4xl font-bold mb-4">Base64 Encoder</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Convert text and strings to Base64 encoding instantly.</p>

        <div x-data="base64Encoder()" class="space-y-6">
            <!-- Input Area -->
            <div>
                <label class="block font-semibold mb-2">Original Text</label>
                <textarea
                    x-model="input"
                    @input="encode()"
                    placeholder="Enter text to encode..."
                    class="w-full h-48 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
                <div class="mt-2 flex gap-2">
                    <button @click="reset()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Reset</button>
                    <button @click="loadExample()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Load Example</button>
                </div>
            </div>

            <!-- Output Area -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="block font-semibold">Base64 Encoded</label>
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
                <div class="bg-blue-50 dark:bg-gray-800 p-4 rounded">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Encoded Size</div>
                    <div class="text-2xl font-bold" x-text="`${output.length} chars`"></div>
                </div>
            </div>
        </div>

        <div class="mt-12 space-y-6">
            <div>
                <h2 class="text-2xl font-bold mb-4">What is Base64?</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Base64 is a binary-to-text encoding that represents binary data in ASCII string format. It's commonly used for:</p>
                <ul class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-400">
                    <li>Sending images and files via email or HTTP</li>
                    <li>Data URLs in HTML and CSS</li>
                    <li>API authentication tokens</li>
                    <li>Encoding sensitive data for transmission</li>
                </ul>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-4">How to Use</h2>
                <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
                    <li>Paste or type your text in the input field</li>
                    <li>It encodes instantly as you type</li>
                    <li>Click "Copy" to copy the encoded result</li>
                    <li>Use the encoded text wherever needed</li>
                </ol>
            </div>
        </div>
    </div>

    <aside>
        <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-6 border border-blue-200 dark:border-gray-700 sticky top-20">
            <h3 class="font-bold mb-4">Related Tools</h3>
            <div class="space-y-2">
                <a href="/base64-decoder" class="block p-3 bg-white dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="font-semibold text-sm">Base64 Decoder</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Decode Base64</div>
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
function base64Encoder() {
    return {
        input: '',
        output: '',

        encode() {
            try {
                this.output = btoa(unescape(encodeURIComponent(this.input)));
            } catch (e) {
                this.output = '';
            }
        },

        reset() {
            this.input = '';
            this.output = '';
        },

        loadExample() {
            this.input = 'Hello, World! This is Base64 encoding.';
            this.encode();
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
