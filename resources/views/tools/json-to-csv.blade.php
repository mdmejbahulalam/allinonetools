@extends('layouts.app')

@section('title', 'JSON to CSV Converter - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <a href="{{ route('home') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Home</a>
            <span class="text-gray-400"> / </span>
            <span class="text-gray-900 dark:text-white">JSON to CSV</span>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">JSON Input</h2>
                <textarea
                    x-model="input"
                    @input="convert()"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-mono text-sm"
                    rows="8"
                    placeholder='[{"name":"john","email":"john@example.com"}]'
                ></textarea>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">CSV Output</h2>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white max-h-96 overflow-auto">
                    <code class="text-sm whitespace-pre-wrap" x-text="output"></code>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function jsonToCsv() {
    return {
        input: '[{"name":"john","email":"john@example.com"}]',
        output: 'name,email\njohn,john@example.com',

        convert() {
            try {
                const data = JSON.parse(this.input);
                if (!Array.isArray(data) || data.length === 0) {
                    this.output = '';
                    return;
                }

                const headers = Object.keys(data[0]);
                let csv = headers.join(',') + '\n';

                for (const row of data) {
                    csv += headers.map(h => row[h] || '').join(',') + '\n';
                }

                this.output = csv.trim();
            } catch (e) {
                this.output = 'Invalid JSON';
            }
        }
    }
}
</script>

<div x-data="jsonToCsv()"></div>
@endsection
