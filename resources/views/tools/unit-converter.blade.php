@extends('layouts.app')

@section('title', 'Unit Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Unit Converter</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Unit Converter</h1>

            <div x-data="unitConverter()" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Conversion Type</label>
                    <select
                        x-model="type"
                        @change="reset()"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                    >
                        <option value="length">Length</option>
                        <option value="weight">Weight</option>
                        <option value="temperature">Temperature</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">From</label>
                        <input
                            x-model.number="value"
                            @input="convert()"
                            type="number"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">To</label>
                        <input
                            :value="result.toFixed(2)"
                            readonly
                            type="number"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-white"
                        />
                    </div>
                </div>

                <button @click="swap()" class="w-full bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-900 dark:text-white font-medium py-2 rounded-lg transition">
                    ⇅ Swap
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function unitConverter() {
    return {
        type: 'length',
        value: 1,
        result: 0,

        convert() {
            const conversions = {
                length: { m: 1, km: 0.001, cm: 100, mm: 1000, mi: 0.000621, yd: 1.094, ft: 3.281, in: 39.37 },
                weight: { kg: 1, g: 1000, mg: 1000000, lb: 2.205, oz: 35.274, t: 0.001 },
                temperature: null
            };

            if (this.type === 'temperature') {
                this.result = (this.value * 9/5) + 32;
            } else {
                this.result = this.value;
            }
        },

        swap() {
            // Basic swap - would need more logic for full implementation
        },

        reset() {
            this.value = 1;
            this.convert();
        },

        init() {
            this.convert();
        }
    }
}
</script>

<div x-data="unitConverter()" x-init="init()"></div>
@endsection
