@extends('layouts.app')

@section('title', 'URL Encoder - Encode URLs Online')
@section('meta_description', 'Encode and decode URLs instantly. Convert special characters to percent-encoded format.')

@section('content')
<nav class="mb-8 flex items-center gap-2 text-sm">
    <a href="/" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
    <span class="text-gray-400">/</span>
    <span class="text-gray-600 dark:text-gray-400">URL Encoder</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <h1 class="text-4xl font-bold mb-4">URL Encoder & Decoder</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Encode and decode URLs with special characters instantly.</p>

        <div x-data="urlCoder()" class="space-y-6">
            <!-- Tabs -->
            <div class="flex gap-2 border-b border-gray-300 dark:border-gray-700">
                <button @click="mode = 'encode'" :class="{ 'border-b-2 border-blue-600 text-blue-600': mode === 'encode' }" class="px-4 py-2 font-semibold">Encode</button>
                <button @click="mode = 'decode'" :class="{ 'border-b-2 border-blue-600 text-blue-600': mode === 'decode' }" class="px-4 py-2 font-semibold">Decode</button>
            </div>

            <!-- Encode Tab -->
            <div x-show="mode === 'encode'" class="space-y-4">
                <div>
                    <label class="block font-semibold mb-2">Original URL</label>
                    <textarea
                        x-model="encodeInput"
                        @input="encode()"
                        placeholder="Paste your URL or text..."
                        class="w-full h-32 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    ></textarea>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block font-semibold">Encoded URL</label>
                        <button @click="copyEncoded()" class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                            📋 Copy
                        </button>
                    </div>
                    <textarea
                        x-model="encodeOutput"
                        readonly
                        class="w-full h-32 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 font-mono text-sm focus:outline-none"
                    ></textarea>
                </div>

                <button @click="encodeExample()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Load Example</button>
            </div>

            <!-- Decode Tab -->
            <div x-show="mode === 'decode'" class="space-y-4">
                <div>
                    <label class="block font-semibold mb-2">Encoded URL</label>
                    <textarea
                        x-model="decodeInput"
                        @input="decode()"
                        placeholder="Paste your encoded URL..."
                        class="w-full h-32 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    ></textarea>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block font-semibold">Decoded URL</label>
                        <button @click="copyDecoded()" class="px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                            📋 Copy
                        </button>
                    </div>
                    <textarea
                        x-model="decodeOutput"
                        readonly
                        class="w-full h-32 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 font-mono text-sm focus:outline-none"
                    ></textarea>
                </div>

                <button @click="decodeExample()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Load Example</button>
            </div>
        </div>

        <div class="mt-12 space-y-6">
            <div>
                <h2 class="text-2xl font-bold mb-4">What is URL Encoding?</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">URL encoding (percent encoding) converts special characters into a format that is safe to use in URLs. Special characters are replaced with % followed by two hexadecimal digits.</p>
                <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded font-mono text-sm">
                    Space → %20<br>
                    & → %26<br>
                    ? → %3F
                </div>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-4">When to Use</h2>
                <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Encode query parameters with special characters</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Prepare URLs for API calls</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Decode obfuscated URLs</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Handle URLs with international characters</span>
                    </li>
                </ul>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-4">Common Special Characters</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                    <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded font-mono">Space: %20</div>
                    <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded font-mono"># : %23</div>
                    <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded font-mono">& : %26</div>
                    <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded font-mono">? : %3F</div>
                    <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded font-mono">= : %3D</div>
                    <div class="bg-gray-100 dark:bg-gray-800 p-3 rounded font-mono">, : %2C</div>
                </div>
            </div>
        </div>
    </div>

    <aside>
        <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-6 border border-blue-200 dark:border-gray-700 sticky top-20">
            <h3 class="font-bold mb-4">Related Encoding Tools</h3>
            <div class="space-y-2">
                <a href="/base64-encoder" class="block p-3 bg-white dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="font-semibold text-sm">Base64 Encoder</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Encode to Base64</div>
                </a>
                <a href="/base64-decoder" class="block p-3 bg-white dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="font-semibold text-sm">Base64 Decoder</div>
                    <div class="text-xs text-gray-600 dark:text-gray-400">Decode Base64</div>
                </a>
            </div>
        </div>
    </aside>
</div>

<script>
function urlCoder() {
    return {
        mode: 'encode',
        encodeInput: '',
        encodeOutput: '',
        decodeInput: '',
        decodeOutput: '',

        encode() {
            this.encodeOutput = encodeURIComponent(this.encodeInput);
        },

        decode() {
            try {
                this.decodeOutput = decodeURIComponent(this.decodeInput);
            } catch (e) {
                this.decodeOutput = 'Invalid URL encoding';
            }
        },

        copyEncoded() {
            navigator.clipboard.writeText(this.encodeOutput).then(() => {
                alert('Copied to clipboard!');
            });
        },

        copyDecoded() {
            navigator.clipboard.writeText(this.decodeOutput).then(() => {
                alert('Copied to clipboard!');
            });
        },

        encodeExample() {
            this.encodeInput = 'Hello, World! This is a test URL with special characters?';
            this.encode();
        },

        decodeExample() {
            this.decodeInput = 'Hello%2C%20World!%20This%20is%20a%20test%20URL%20with%20special%20characters%3F';
            this.decode();
        }
    };
}
</script>
@endsection
