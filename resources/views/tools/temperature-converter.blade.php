@extends('layouts.app')

@section('title', 'Temperature Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Temperature Converter</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Temperature Converter</h1>

            <div x-data="tempConverter()" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Celsius (°C)</label>
                        <input
                            x-model.number="celsius"
                            @input="fromCelsius()"
                            type="number"
                            step="0.1"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder="°C"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fahrenheit (°F)</label>
                        <input
                            x-model.number="fahrenheit"
                            @input="fromFahrenheit()"
                            type="number"
                            step="0.1"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder="°F"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kelvin (K)</label>
                        <input
                            x-model.number="kelvin"
                            @input="fromKelvin()"
                            type="number"
                            step="0.1"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder="K"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <p class="text-sm text-blue-600 dark:text-blue-400 mb-2">Celsius</p>
                        <p class="text-2xl font-bold text-blue-900 dark:text-blue-300" x-text="celsius.toFixed(2) + ' °C'"></p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <p class="text-sm text-green-600 dark:text-green-400 mb-2">Fahrenheit</p>
                        <p class="text-2xl font-bold text-green-900 dark:text-green-300" x-text="fahrenheit.toFixed(2) + ' °F'"></p>
                    </div>
                    <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg p-4">
                        <p class="text-sm text-purple-600 dark:text-purple-400 mb-2">Kelvin</p>
                        <p class="text-2xl font-bold text-purple-900 dark:text-purple-300" x-text="kelvin.toFixed(2) + ' K'"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function tempConverter() {
    return {
        celsius: 0,
        fahrenheit: 32,
        kelvin: 273.15,

        fromCelsius() {
            this.fahrenheit = (this.celsius * 9/5) + 32;
            this.kelvin = this.celsius + 273.15;
        },

        fromFahrenheit() {
            this.celsius = (this.fahrenheit - 32) * 5/9;
            this.kelvin = this.celsius + 273.15;
        },

        fromKelvin() {
            this.celsius = this.kelvin - 273.15;
            this.fahrenheit = (this.celsius * 9/5) + 32;
        }
    }
}
</script>

<div x-data="tempConverter()"></div>
@endsection
