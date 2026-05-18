@extends('layouts.app')

@section('title', 'Number to Words Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Number to Words</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Number to Words Converter</h1>

            <div x-data="numberToWords()" class="space-y-6">
                <input
                    x-model.number="number"
                    @input="convert()"
                    type="number"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    placeholder="Enter a number..."
                />

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white min-h-24">
                    <code x-text="output"></code>
                </div>

                <button @click="navigator.clipboard.writeText(output)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                    Copy
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function numberToWords() {
    const ones = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    const teens = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    const tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    return {
        number: 0,
        output: '',

        convert() {
            if (this.number === 0) {
                this.output = 'zero';
                return;
            }
            const words = this._convertToWords(this.number);
            this.output = words.charAt(0).toUpperCase() + words.slice(1);
        },

        _convertToWords(num) {
            if (num === 0) return '';
            if (num < 10) return ones[num];
            if (num < 20) return teens[num - 10];
            if (num < 100) return tens[Math.floor(num / 10)] + (num % 10 ? ' ' + ones[num % 10] : '');
            if (num < 1000) return ones[Math.floor(num / 100)] + ' hundred' + (num % 100 ? ' ' + this._convertToWords(num % 100) : '');
            return this._convertToWords(Math.floor(num / 1000)) + ' thousand' + (num % 1000 ? ' ' + this._convertToWords(num % 1000) : '');
        }
    }
}
</script>

<div x-data="numberToWords()"></div>
@endsection
