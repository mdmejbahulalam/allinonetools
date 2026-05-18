@extends('layouts.app')

@section('title', 'Base32 Encoder - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Base32 Encoder</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Base32 Encoder</h1>

            <div x-data="base32Encoder()" class="space-y-6">
                <textarea
                    x-model="input"
                    @input="encode()"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-mono"
                    rows="6"
                    placeholder="Enter text to encode..."
                ></textarea>

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Base32 Output</p>
                    <div class="font-mono text-sm text-gray-900 dark:text-white break-all" x-text="output || '(empty)'"></div>
                </div>

                <button @click="navigator.clipboard.writeText(output)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                    Copy
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function base32Encoder() {
    return {
        input: '',
        output: '',

        encode() {
            const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
            let bits = 0, value = 0, output = '';

            for (let i = 0; i < this.input.length; i++) {
                value = (value << 8) | this.input.charCodeAt(i);
                bits += 8;

                while (bits >= 5) {
                    output += alphabet[(value >>> (bits - 5)) & 31];
                    bits -= 5;
                }
            }

            if (bits > 0) {
                output += alphabet[(value << (5 - bits)) & 31];
            }

            while (output.length % 8 !== 0) {
                output += '=';
            }

            this.output = output;
        }
    }
}
</script>

<div x-data="base32Encoder()"></div>
@endsection
