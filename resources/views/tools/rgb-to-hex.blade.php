@extends('layouts.app')

@section('title', 'RGB to HEX Converter - ' . config('app.name'))
@section('meta_description', 'Convert RGB color values to HEX format instantly.')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('category', 'color-tools') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Color Tools</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white">RGB to HEX</span>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">RGB to HEX Converter</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Convert RGB color values to HEX format</p>

                    <div x-data="rgbToHex()" class="space-y-6">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Red (0-255)</label>
                                <input
                                    x-model.number="red"
                                    @input="convert()"
                                    type="number"
                                    min="0"
                                    max="255"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Green (0-255)</label>
                                <input
                                    x-model.number="green"
                                    @input="convert()"
                                    type="number"
                                    min="0"
                                    max="255"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Blue (0-255)</label>
                                <input
                                    x-model.number="blue"
                                    @input="convert()"
                                    type="number"
                                    min="0"
                                    max="255"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                />
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Color Preview</label>
                                <div
                                    :style="'background-color: rgb(' + red + ', ' + green + ', ' + blue + ')'"
                                    class="w-full h-24 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                                ></div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">HEX Output</label>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white font-mono">
                                <code x-text="output"></code>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button @click="copyToClipboard()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                                Copy HEX
                            </button>
                            <button @click="reset()" class="flex-1 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-900 dark:text-white font-medium py-2 rounded-lg transition">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-gray-900 dark:text-white mb-4">Related Tools</h3>
                <div class="space-y-2">
                    <a href="{{ route('tool.show', 'hex-to-rgb') }}" class="block p-3 bg-white dark:bg-gray-800 rounded hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm transition">
                        → HEX to RGB
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function rgbToHex() {
    return {
        red: 255,
        green: 87,
        blue: 51,
        output: '#FF5733',

        convert() {
            const r = Math.max(0, Math.min(255, this.red)).toString(16).padStart(2, '0').toUpperCase();
            const g = Math.max(0, Math.min(255, this.green)).toString(16).padStart(2, '0').toUpperCase();
            const b = Math.max(0, Math.min(255, this.blue)).toString(16).padStart(2, '0').toUpperCase();
            this.output = `#${r}${g}${b}`;
        },

        copyToClipboard() {
            navigator.clipboard.writeText(this.output);
            alert('HEX copied!');
        },

        reset() {
            this.red = 255;
            this.green = 87;
            this.blue = 51;
            this.convert();
        }
    }
}
</script>
@endsection
