@extends('layouts.app')

@section('title', 'JSON Formatter & Validator')
@section('meta_description', 'Format, validate, and beautify JSON code online. Instant formatting with error detection.')

@section('content')
<nav class="mb-8 flex items-center gap-2 text-sm">
    <a href="/" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
    <span class="text-gray-400">/</span>
    <span class="text-gray-600 dark:text-gray-400">JSON Formatter</span>
</nav>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <h1 class="text-4xl font-bold mb-4">JSON Formatter</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">Format, validate, and beautify JSON with instant error detection.</p>

        <div x-data="jsonFormatter()" class="space-y-6">
            <!-- Input Area -->
            <div>
                <label class="block font-semibold mb-2">Paste JSON</label>
                <textarea
                    x-model="input"
                    @input="format()"
                    placeholder="Paste your JSON here..."
                    class="w-full h-48 p-4 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                ></textarea>
                <div class="mt-2 flex gap-2">
                    <button @click="format()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Format</button>
                    <button @click="reset()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Reset</button>
                    <button @click="loadExample()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Load Example</button>
                </div>
                <div x-show="error" class="mt-2 p-3 bg-red-100 dark:bg-red-900 border border-red-400 text-red-700 dark:text-red-200 rounded">
                    <strong>Error:</strong> <span x-text="error"></span>
                </div>
            </div>

            <!-- Output Area -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="block font-semibold">Formatted Output</label>
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
                    <div class="text-sm text-gray-600 dark:text-gray-400">Input Size</div>
                    <div class="text-2xl font-bold" x-text="`${(input.length / 1024).toFixed(2)} KB`"></div>
                </div>
                <div class="bg-blue-50 dark:bg-gray-800 p-4 rounded">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Output Size</div>
                    <div class="text-2xl font-bold" x-text="`${(output.length / 1024).toFixed(2)} KB`"></div>
                </div>
                <div class="bg-blue-50 dark:bg-gray-800 p-4 rounded">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Lines</div>
                    <div class="text-2xl font-bold" x-text="`${output.split('\\n').length}`"></div>
                </div>
            </div>
        </div>

        <div class="mt-12 space-y-6">
            <div>
                <h2 class="text-2xl font-bold mb-4">How to Use</h2>
                <ol class="list-decimal list-inside space-y-2 text-gray-600 dark:text-gray-400">
                    <li>Paste your JSON code in the input area</li>
                    <li>Click "Format" or it auto-formats as you type</li>
                    <li>Invalid JSON will show an error message</li>
                    <li>Click "Copy" to copy the formatted output</li>
                </ol>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-4">Benefits</h2>
                <ul class="space-y-2 text-gray-600 dark:text-gray-400">
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Instant formatting with proper indentation</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Real-time validation and error detection</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-green-500 mt-1">✓</span>
                        <span>Shows file size statistics</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
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
                <div>
                    <span class="text-gray-600 dark:text-gray-400">Speed:</span>
                    <div class="font-semibold">Instant</div>
                </div>
            </div>
        </div>
    </aside>
</div>

<script>
function jsonFormatter() {
    return {
        input: '',
        output: '',
        error: '',

        format() {
            try {
                this.error = '';
                if (!this.input.trim()) {
                    this.output = '';
                    return;
                }
                const parsed = JSON.parse(this.input);
                this.output = JSON.stringify(parsed, null, 2);
            } catch (e) {
                this.error = e.message;
                this.output = '';
            }
        },

        reset() {
            this.input = '';
            this.output = '';
            this.error = '';
        },

        loadExample() {
            this.input = JSON.stringify({
                name: "John Doe",
                email: "john@example.com",
                age: 30,
                address: {
                    street: "123 Main St",
                    city: "New York",
                    country: "USA"
                },
                hobbies: ["reading", "coding", "gaming"]
            });
            this.format();
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
