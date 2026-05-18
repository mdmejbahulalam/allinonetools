@extends('layouts.app')

@section('title', 'Hex to RGB Converter - ' . config('app.name'))
@section('meta_description', 'Convert HEX color codes to RGB format instantly. Perfect for web design and development.')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400">/</span>
            <a href="{{ route('category', 'color-tools') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Color Tools</a>
            <span class="text-gray-400">/</span>
            <span class="text-gray-900 dark:text-white">Hex to RGB</span>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">HEX to RGB Converter</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Convert HEX color codes to RGB format</p>

                    <div x-data="hexToRgb()" class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">HEX Color Code</label>
                            <input
                                x-model="input"
                                @input="convert()"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="#FF5733"
                                maxlength="7"
                            />
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Color Preview</label>
                                <div
                                    :style="'background-color: ' + input"
                                    class="w-full h-24 rounded-lg border-2 border-gray-300 dark:border-gray-600"
                                ></div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">RGB Output</label>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white font-mono">
                                <code x-text="output"></code>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button @click="copyToClipboard()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                                Copy RGB
                            </button>
                            <button @click="reset()" class="flex-1 bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-900 dark:text-white font-medium py-2 rounded-lg transition">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                    <h3 class="font-semibold text-blue-900 dark:text-blue-300 mb-2">🎨 Color Format Guide</h3>
                    <p class="text-sm text-blue-800 dark:text-blue-400 mb-2"><strong>HEX:</strong> #RRGGBB (e.g., #FF5733)</p>
                    <p class="text-sm text-blue-800 dark:text-blue-400"><strong>RGB:</strong> rgb(R, G, B) (e.g., rgb(255, 87, 51))</p>
                </div>

                <h3 class="font-bold text-gray-900 dark:text-white mb-4">Related Tools</h3>
                <div class="space-y-2">
                    <a href="{{ route('tool.show', 'rgb-to-hex') }}" class="block p-3 bg-white dark:bg-gray-800 rounded hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm transition">
                        → RGB to HEX
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function hexToRgb() {
    return {
        input: '#FF5733',
        output: 'rgb(255, 87, 51)',

        convert() {
            const hex = this.input.trim();
            const hexRegex = /^#[0-9A-F]{6}$/i;

            if (!hexRegex.test(hex)) {
                this.output = 'Invalid HEX format';
                return;
            }

            const r = parseInt(hex.slice(1, 3), 16);
            const g = parseInt(hex.slice(3, 5), 16);
            const b = parseInt(hex.slice(5, 7), 16);

            this.output = `rgb(${r}, ${g}, ${b})`;
        },

        copyToClipboard() {
            navigator.clipboard.writeText(this.output);
            alert('RGB copied!');
        },

        reset() {
            this.input = '#FF5733';
            this.convert();
        }
    }
}
</script>
@endsection
