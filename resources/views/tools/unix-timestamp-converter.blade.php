@extends('layouts.app')

@section('title', 'Unix Timestamp Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">Unix Timestamp Converter</span>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Unix Timestamp Converter</h1>

            <div x-data="timestampConverter()" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date & Time</label>
                        <input
                            x-model="dateInput"
                            @change="dateToTimestamp()"
                            type="datetime-local"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Unix Timestamp</label>
                        <input
                            x-model="timestamp"
                            @change="timestampToDate()"
                            type="number"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                            placeholder="Enter timestamp..."
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <p class="text-sm text-blue-600 dark:text-blue-400 mb-2">Current Timestamp</p>
                        <p class="text-xl font-mono font-bold text-blue-900 dark:text-blue-300" x-text="currentTimestamp"></p>
                        <button @click="timestamp = currentTimestamp; timestampToDate()" class="mt-2 text-sm bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700">
                            Use Now
                        </button>
                    </div>

                    <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <p class="text-sm text-green-600 dark:text-green-400 mb-2">Formatted Output</p>
                        <p class="text-lg font-mono font-bold text-green-900 dark:text-green-300" x-text="formattedDate || '—'"></p>
                    </div>
                </div>

                <button @click="navigator.clipboard.writeText(timestamp)" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg transition">
                    Copy Timestamp
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function timestampConverter() {
    return {
        timestamp: '',
        dateInput: '',
        currentTimestamp: 0,
        formattedDate: '',

        init() {
            this.currentTimestamp = Math.floor(Date.now() / 1000);
            const now = new Date();
            const offset = now.getTimezoneOffset() * 60000;
            this.dateInput = new Date(now - offset).toISOString().slice(0, 16);
        },

        dateToTimestamp() {
            if (!this.dateInput) return;
            const date = new Date(this.dateInput);
            this.timestamp = Math.floor(date.getTime() / 1000);
            this.updateFormatted();
        },

        timestampToDate() {
            if (!this.timestamp) return;
            const date = new Date(parseInt(this.timestamp) * 1000);
            const offset = date.getTimezoneOffset() * 60000;
            this.dateInput = new Date(date - offset).toISOString().slice(0, 16);
            this.updateFormatted();
        },

        updateFormatted() {
            if (!this.timestamp) {
                this.formattedDate = '';
                return;
            }
            const date = new Date(parseInt(this.timestamp) * 1000);
            this.formattedDate = date.toLocaleString();
        }
    }
}
</script>

<div x-data="timestampConverter()" x-init="init()"></div>
@endsection
