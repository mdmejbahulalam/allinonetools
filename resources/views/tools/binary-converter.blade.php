@extends('layouts.app')

@section('title', 'Binary Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Binary Converter</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Binary Converter</h1>

            <div x-data="binaryConverter()" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Decimal Number</label>
                    <input
                        x-model.number="decimal"
                        @input="convert()"
                        type="number"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        placeholder="Enter a number..."
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Binary</p>
                        <code class="text-gray-900 dark:text-white font-mono break-all" x-text="binary"></code>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Hexadecimal</p>
                        <code class="text-gray-900 dark:text-white font-mono" x-text="hex"></code>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Octal</p>
                        <code class="text-gray-900 dark:text-white font-mono" x-text="octal"></code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function binaryConverter() {
    return {
        decimal: 255,
        binary: '',
        hex: '',
        octal: '',

        convert() {
            this.binary = this.decimal.toString(2);
            this.hex = this.decimal.toString(16).toUpperCase();
            this.octal = this.decimal.toString(8);
        },

        init() {
            this.convert();
        }
    }
}
</script>

<div x-data="binaryConverter()" x-init="init()"></div>
@endsection
