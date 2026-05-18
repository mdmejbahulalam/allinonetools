@extends('layouts.app')

@section('title', 'Password Generator - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Password Generator</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Password Generator</h1>

            <div x-data="passwordGenerator()" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Password Length: <span x-text="length"></span>
                    </label>
                    <input type="range" x-model.number="length" min="8" max="32" class="w-full">
                </div>

                <div class="space-y-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" x-model="options.uppercase" class="w-4 h-4">
                        <span class="text-gray-700 dark:text-gray-300">Include Uppercase (A-Z)</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" x-model="options.lowercase" checked class="w-4 h-4">
                        <span class="text-gray-700 dark:text-gray-300">Include Lowercase (a-z)</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" x-model="options.numbers" checked class="w-4 h-4">
                        <span class="text-gray-700 dark:text-gray-300">Include Numbers (0-9)</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" x-model="options.symbols" checked class="w-4 h-4">
                        <span class="text-gray-700 dark:text-gray-300">Include Symbols (!@#$%)</span>
                    </label>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white font-mono text-lg break-all">
                    <code x-text="password"></code>
                </div>

                <div class="flex gap-4">
                    <button @click="generate()" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded-lg transition">
                        Generate
                    </button>
                    <button @click="navigator.clipboard.writeText(password)" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                        Copy
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function passwordGenerator() {
    return {
        length: 16,
        password: '',
        options: {
            uppercase: true,
            lowercase: true,
            numbers: true,
            symbols: true
        },

        generate() {
            const uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const lowercase = 'abcdefghijklmnopqrstuvwxyz';
            const numbers = '0123456789';
            const symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';

            let chars = '';
            if (this.options.uppercase) chars += uppercase;
            if (this.options.lowercase) chars += lowercase;
            if (this.options.numbers) chars += numbers;
            if (this.options.symbols) chars += symbols;

            let pwd = '';
            for (let i = 0; i < this.length; i++) {
                pwd += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            this.password = pwd;
        },

        init() {
            this.generate();
        }
    }
}
</script>

<div x-data="passwordGenerator()" x-init="init()"></div>
@endsection
