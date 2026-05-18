@extends('layouts.app')

@section('title', 'Morse Code Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Morse Code Converter</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Morse Code Converter</h1>

            <div x-data="morseConverter()" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Text to Morse</label>
                    <textarea
                        x-model="textInput"
                        @input="toMorse()"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        rows="4"
                        placeholder="Enter text..."
                    ></textarea>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Morse Code</p>
                    <div class="font-mono text-sm text-gray-900 dark:text-white break-all" x-text="morseOutput || '(empty)'"></div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Morse to Text</label>
                    <textarea
                        x-model="morseInput"
                        @input="toText()"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        rows="4"
                        placeholder="Enter morse code (use space between letters, / between words)..."
                    ></textarea>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Text</p>
                    <div class="font-mono text-sm text-gray-900 dark:text-white break-all" x-text="textOutput || '(empty)'"></div>
                </div>

                <button @click="navigator.clipboard.writeText(morseOutput || textOutput)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                    Copy Result
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function morseConverter() {
    return {
        textInput: '',
        morseInput: '',
        morseOutput: '',
        textOutput: '',

        morseMap: {
            'A': '.-', 'B': '-...', 'C': '-.-.', 'D': '-..', 'E': '.', 'F': '..-.',
            'G': '--.', 'H': '....', 'I': '..', 'J': '.---', 'K': '-.-', 'L': '.-..',
            'M': '--', 'N': '-.', 'O': '---', 'P': '.--.', 'Q': '--.-', 'R': '.-.',
            'S': '...', 'T': '-', 'U': '..-', 'V': '...-', 'W': '.--', 'X': '-..-',
            'Y': '-.--', 'Z': '--..', '0': '-----', '1': '.----', '2': '..---',
            '3': '...--', '4': '....-', '5': '.....', '6': '-....', '7': '--...',
            '8': '---..', '9': '----.', '.': '.-.-.-', ',': '--..--', '?': '..--..',
            "'": '.----', '!': '-.-.--', '/': '-..-.', '(': '-.--.', ')': '-.--.-',
            '&': '.-...', ':': '---...', ';': '-.-.-.', '=': '-...-', '+': '.-.-.',
            '-': '-....-', '_': '..--.-', '"': '.-..-.', '$': '...-..-', '@': '.--.-.'
        },

        toMorse() {
            this.morseOutput = this.textInput.toUpperCase().split('').map(char => {
                if (char === ' ') return '/';
                return this.morseMap[char] || '';
            }).filter(m => m).join(' ');
        },

        toText() {
            const reverseMorse = Object.entries(this.morseMap).reduce((acc, [char, morse]) => {
                acc[morse] = char;
                return acc;
            }, {});

            this.textOutput = this.morseInput.split('/').map(word => {
                return word.trim().split(' ').map(code => reverseMorse[code.trim()] || '?').join('');
            }).join(' ');
        }
    }
}
</script>

<div x-data="morseConverter()"></div>
@endsection
